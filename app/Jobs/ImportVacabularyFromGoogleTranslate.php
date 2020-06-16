<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Google_Service_Sheets;
use Google_Client;
use App\Language;
use App\Word;
use App\Translation;
use App\TranslationStatistics;
use App\ImportProgress;
use App\ISOLanguage;

class ImportVacabularyFromGoogleTranslate implements ShouldQueue {

    use Dispatchable,
        InteractsWithQueue,
        Queueable,
        SerializesModels;

    protected $spreadsheetId;
    protected $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($spreadsheetId, $user) {
        $this->spreadsheetId = $spreadsheetId;
        $this->user = $user;
    }

   
    public function handle() {

        $user = $this->user;

        ImportProgress::create_new($user, 0);


        $client             = $this->getClient();
        $service            = new Google_Service_Sheets($client);
        $spreadsheetId      = $this->spreadsheetId;
        $spreadSheet        = $service->spreadsheets->get($spreadsheetId);
        $sheets             = $spreadSheet->getSheets();
        $name_first_sheet   = reset($sheets)->properties->title;

      
        if (empty($name_first_sheet)) {
            return "No data found";
        }

        $range                  = $name_first_sheet . '!A1:D';
        $response               = $service->spreadsheets_values->get($spreadsheetId, $range);
        $values                 = $response->getValues();
        $count_uploaded_words   = 0;
        $count_all_words        = count($values);
        
        foreach ($values as $row) {
            $count_uploaded_words++;

            $progress = round($count_uploaded_words * 100 / $count_all_words);
            ImportProgress::create_new($user, $progress);

            
            $language1  = Language::get_language($row[0]);
            $language2  = Language::get_language($row[1]);
            
            if($language1 == null || $language2 == null){
                continue;
            }
            $word1      = Word::get_word($user, $language1, $row[2]);
            $word2      = Word::get_word($user, $language2, $row[3]); 
            $translate  = Translation::get_translation($word1, $word2, $user); 

            
        }
        

        ImportProgress::create_new($user, 100);
    }

    /**
     * Returns an authorized API client.
     * @return Google_Client the authorized client object
     */
    function getClient() {
        $client = new Google_Client();
        $client->setApplicationName('Google Sheets API PHP Quickstart');
        $client->setScopes(Google_Service_Sheets::SPREADSHEETS_READONLY);
        $client->setAuthConfig(base_path() . '/credentials.json');
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');

        // Load previously authorized token from a file, if it exists.
        // The file token.json stores the user's access and refresh tokens, and is
        // created automatically when the authorization flow completes for the first
        // time.
        $tokenPath = base_path() . '/token.json';
        if (file_exists($tokenPath)) {
            $accessToken = json_decode(file_get_contents($tokenPath), true);
            $client->setAccessToken($accessToken);
        }

        // If there is no previous token or it's expired.
        if ($client->isAccessTokenExpired()) {
            // Refresh the token if possible, else fetch a new one.
            if ($client->getRefreshToken()) {
                $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
            } else {
                // Request authorization from the user.
                $authUrl = $client->createAuthUrl();
                printf("Open the following link in your browser:\n%s\n", $authUrl);
                print 'Enter verification code: ';
                $authCode = trim(fgets(STDIN));

                // Exchange authorization code for an access token.
                $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
                $client->setAccessToken($accessToken);

                // Check to see if there was an error.
                if (array_key_exists('error', $accessToken)) {
                    throw new Exception(join(', ', $accessToken));
                }
            }
            // Save the token to a file.
            if (!file_exists(dirname($tokenPath))) {
                mkdir(dirname($tokenPath), 0700, true);
            }
            file_put_contents($tokenPath, json_encode($client->getAccessToken()));
        }
        return $client;
    }

}
