import '../stylesheets/theme.scss';
import tabs from './components/tabs';

tabs.init();

window.DustPressStarter = (function(window, document, $) {

    var app = {
        currentPage: 1,
        currentPageEvents:1,
        currentPageUpcoming:1,
    };

    app.cache = function () {
        app.$mainContainer              = $("#main-content");
        app.$postsContainer             = $("#post-list-container");
        app.$upcomingContainer          = $("#upcoming-container");
        app.$eventsContainer            = $("#events-container");
        app.$loadMorePosts              = app.$mainContainer.find("#js-load-more-posts");
        app.$loadMoreUpcomingEvents     = app.$mainContainer.find("#js-load-more-upcoming-events");
        app.$loadMoreEvents             = app.$mainContainer.find("#js-load-more-events");
        app.maxNumPages                 = parseInt(app.$loadMorePosts.data('max-num-pages'));
        app.maxNumPagesUpcomingEvents   = parseInt(app.$loadMoreUpcomingEvents.data('max-num-pages'));
        app.maxNumPagesEvents           = parseInt(app.$loadMoreEvents.data('max-num-pages'));
    };

    app.init = function() {
        app.cache();

        app.$loadMorePosts.on("click", app.loadMorePosts);
        app.$loadMoreUpcomingEvents.on("click", app.loadMoreUpcomingEvents);
        app.$loadMoreEvents.on("click", app.loadMoreEvents);
    };

    app.loadMorePosts = function (e) {
      
        // Load more with DustPress.js
        dp( 'PageArchive/Query', {
            args: {
                page: ++app.currentPage
            },
            tidy: true,
            partial: "post-list",
        }).then( ( data ) => {
            app.$postsContainer.append(data.success);
            if ( app.currentPage === app.maxNumPages ) {
                app.$loadMorePosts.hide();
            }
        }).catch( ( error ) => {
            console.log(error);
        });

        return false;
    };

    app.loadMoreUpcomingEvents = function (e) {
        
        // Load more with DustPress.js
        dp( 'PageEvents/UpcomingEvents', {
            args: {
                page: ++app.currentPageUpcoming
            },
            tidy: true,
            partial: 'event-list',
        }).then( ( data ) => {
            app.$upcomingContainer.append(data.success);
            if ( app.currentPageUpcoming === app.maxNumPagesUpcomingEvents ) {
                app.$loadMoreUpcomingEvents.hide();
            }
        }).catch( ( error ) => {
            console.log(error);
        });

        return false;
    };

    app.loadMoreEvents = function (e) {
        
        // Load more with DustPress.js
        dp( 'PageEvents/Events', {
            args: {
                page: ++app.currentPageEvents
            },
            tidy: true,
            partial: 'event-list',
        }).then( ( data ) => {
            app.$eventsContainer.append(data.success);
            if ( app.currentPageEvents === app.maxNumPagesEvents ) {
                app.$loadMoreEvents.hide();
            }
        }).catch( ( error ) => {
            console.log(error);
        });

        return false;
    };

    app.init();

    return app;

}(window, document, jQuery));