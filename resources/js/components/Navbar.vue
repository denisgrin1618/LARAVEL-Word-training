<template>
  <div class="">


    <nav class="shadow  navbar navbar-expand-md navbar-light  " style="background: #4ebdad" >
      <button v-on:click="data_toggle_click" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>


      <a class="navbar-brand mt-1" :href="quiz_start"><img :src="img_logo_sm" ></a>

      <div class="collapse navbar-collapse" id="navbarTogglerDemo03">


        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">

          <li class="nav-item li-local d-none invisible">

            <div class="input-group mb-3 dropdown-item  m-0 p-0 ">
              <div class="input-group-prepend " >
                <a :class="[a-local, btn, bt-grey-silver-hover, border, border-secondary ,  locale == 'ru' ? 'bt-grey-silver text-white' : ''   ]"                   :href="locale_setlocale_ru">RU</a>
                <a :class="[a-local, btn, bt-grey-silver-hover, border, border-secondary ,  locale == 'en' || locale == null ? 'bt-grey-silver text-white' : ''   ]" :href="locale_setlocale_en">EN</a>
                <a :class="[a-local, btn, bt-grey-silver-hover, border, border-secondary, rounded-right ,  locale == 'uk' ? 'bt-grey-silver text-white' : ''   ]"     :href="locale_setlocale_uk">UK</a>
              </div>
            </div>

          </li>

          <li class="nav-item">
            <a class="nav-link text-white" :href="translation_show"><img class='mr-2 img-icon d-none invisible' :src="img_icons_book" width="20" height="20">{{ app_strings_vocabulary }}</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" :href="translation_import" ><img class='mr-2 img-icon d-none invisible' :src="img_icons_download" width="20" height="20">{{ app_strings_import }}</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" :href="quiz_show_all" ><img class='mr-2 img-icon d-none invisible' :src="img_icons_clock" width="20" height="20">{{ app_strings_quiz }}</a>
          </li>
          <li class="nav-item ">
            <a class="nav-link text-white" :href="statistics_show"><img class='mr-2 img-icon d-none invisible' :src="img_icons_graph_up" width="20" height="20">{{app_strings_statistic}}</a>
          </li>
        </ul>








      </div>


    </nav>

    <div class="menu-overlay" v-on:click="menu_overlay_click"></div>
  </div>
</template>

<script>
export default {

  props: ['quiz_start',
          'img_logo_sm',
          'locale',
          'translation_show',
          'translation_import',
          'quiz_show_all',
          'statistics_show',
          'img_icons_book',
          'img_icons_download',
          'img_icons_clock',
          'img_icons_graph_up',
          'app_strings_vocabulary',
          'app_strings_import',
          'app_strings_quiz',
          'app_strings_statistic',
          'locale_setlocale_ru',
          'locale_setlocale_en',
          'locale_setlocale_uk'
  ],

  data() {
    return {
    }
  },

  methods:{
    data_toggle_click: function (event) {
      // navMenuCont = $($(this).data('target'));

      navMenuCont = event.target.data('target');
        if (navMenuCont.attr('id') == 'navbarTogglerDemo03') {
            navMenuCont.animate({
                'width': 'toggle'
            }, 350);
            $(".menu-overlay").fadeIn(500);

            navMenuCont.find('.nav-link')
                    .not('.a-local')
                    .removeClass('text-white')
                    .addClass('text-black');

            $(".li-local").removeClass('d-none invisible');
            $('.div-local').addClass('d-none invisible');
            $('.img-icon').removeClass('d-none invisible');
        }
        console.log('data_toggle_click');
    },

    menu_overlay_click: function (event){
      console.log('menu_overlay_click');
      $(".navbar-toggler").trigger("click");
      $(".menu-overlay").fadeOut(500);
      $("#navbarTogglerDemo03")
              .find('.nav-link')
              .not('.a-local')
              .removeClass('text-black')
              .addClass('text-white');

      $(".div-local").removeClass('d-none invisible');
      $('.li-local').addClass('d-none invisible');
      $('.img-icon').addClass('d-none invisible');
    }
  },

    mounted() {
      // console.log('Component mounted!!');
      // console.log(this.quiz_start);
      // console.log(this.img_logo_sm);
    }

  }

  </script>

<style >
  .menu-overlay {
      display: none;
      background-color: #000;
      bottom: 0;
      left: 0;
      opacity: 0.5;
      filter: alpha(opacity=50);
      /* IE7 & 8 */
      position: fixed;
      right: 0;
      top: 0;
      z-index: 49;
  }
</style>
