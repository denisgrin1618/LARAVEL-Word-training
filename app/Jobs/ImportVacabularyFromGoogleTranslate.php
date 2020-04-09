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

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {

        $user       = $this->user;
        $language1  = Language::find(2);
        $language2  = Language::find(1);
        
        
        $import_progress = ImportProgress::where('user_id', $user->id)->get();
        if ($import_progress->isEmpty()) {
            $import_progress = new ImportProgress;
            $import_progress->user()->associate($user);
            $import_progress->percent_progress = 0;
            $import_progress->save();
        } else {
            $import_progress = $import_progress->first();
        }


        $import_progress->percent_progress = 0;
        $import_progress->save();



        $client = $this->getClient();
        $service = new Google_Service_Sheets($client);
        $spreadsheetId = $this->spreadsheetId;
        $range = 'Сохраненные переводы!A1:D';

        $response = $service->spreadsheets_values->get($spreadsheetId, $range);
        $values = $response->getValues();
        $rezalt = "";



        



        if (empty($values)) {
            $rezalt = "No data found";
        } else {



//            session(['import_progress' => '0']);

            $count_uploaded_words = 0;
            $count_all_words = count($values);
            foreach ($values as $row) {
                $count_uploaded_words++;

                $progress = round($count_uploaded_words * 100 / $count_all_words);

//                session(['import_progress' => $progress]);

                $import_progress->percent_progress = $progress;
                $import_progress->save();
        

                $word1_name = $row[2];
                $word2_name = $row[3];

                $word1 = Word::where('name', $word1_name)
                        ->where('language_id', $language1->id)
                        ->where('user_id', $user->id)
                        ->get();

                if ($word1->isEmpty()) {
                    $word1 = new Word;
                    $word1->name = $word1_name;
                    $word1->language()->associate($language1);
                    $word1->user()->associate($user);
                    $word1->save();
                } else {
                    $word1 = $word1->first();
                }

                $word2 = Word::where('name', $word2_name)
                        ->where('language_id', $language2->id)
                        ->where('user_id', $user->id)
                        ->get();

                if ($word2->isEmpty()) {
                    $word2 = new Word;
                    $word2->name = $word2_name;
                    $word2->language()->associate($language2);
                    $word2->user()->associate($user);
                    $word2->save();
                } else {
                    $word2 = $word2->first();
                }


                $translate = Translation::where('word1_id', $word1->id)
                        ->where('word2_id', $word2->id)
                        ->where('user_id', $user->id)
                        ->get();

                if ($translate->isEmpty()) {
                    $translate = new Translation;
                    $translate->word1_id = $word1->id;
                    $translate->word2_id = $word2->id;
                    $translate->user()->associate($user);
                    $translate->save();
                }
            }
            $rezalt = "Was uploaded " . $count_uploaded_words . " words";
        }


//        session(['import_progress' => 100]);
//        
        $import_progress->percent_progress = 100;
        $import_progress->save();
                
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
