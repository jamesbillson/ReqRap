
    var liveFeed = true; // Set global var
    var liveFeedTimeout = 1000 * 60 * 1;
    var dataset = {}; // This is a variable to be sent on ajax requests for combined filters to be used.

    $(document).ready(function(){

        initNavTabs();
        initNavTabClicks();
        initNavTradeTabs();
        initDatePicker();
        initClubChange();
        initResetClub();
        reloadLiveFeed();

        initialDate = $('#selected-date').html();
        $('.items a').attr('target', '_blank');
    });

    function initClubChange() {

        $('body').on('change','#club',function(){
        
                                    addToDataset("club", $("#club").val()); 
                                    jQuery.ajax({
                                        'type':'GET',
                                        'url':'/entry/ajaxUpdate',
                                        'data':dataset,
                                        'beforeSend':function() { 
                                            $(".items").addClass("loading"); 
                                        },
                                        'complete':function() { $(".items").removeClass("loading"); },'cache':false,'success':function(html){jQuery("#entryList").html(html)}});return false;});
    }

    function reloadLiveFeed() {

       setTimeout(function () {

            // Only reload live feed if no filters have been applied
            if(dataset.filter === undefined && dataset.club === undefined && dataset.dateRange === undefined) {
                jQuery.ajax({'url':'/entry/ajaxUpdate/filter/none','cache':false,'success':function(html){jQuery("#entryList").html(html)}});
            }
            reloadLiveFeed();
        }, liveFeedTimeout)
    }

    function initResetClub() {

        // set-up reset tooltip
        $('#clear-filters').tooltip();

        // Get initial date value

        $('#clear-filters').on('click', function() {

            clearDataset();
        });
    }

    function clearDataset() {

        dataset = {};
        $('#club').val(0);
        setActive('entry-nav-1');
        $('#selected-date').html(initialDate);
    }

    function addToDataset( thisvar, thisval ) {

        delete dataset.thisvar;
        dataset[thisvar] = thisval;
    }

    function initDatePicker() {

        $('body').on('change','#date-picker',function(){
                                                        addToDataset('dateRange', $('#date-picker').val());
                                                        jQuery.ajax({
                                                //        'url':'/entry/ajaxUpdate/dateRange/'+ $('#date-picker').val(),
                                                        'url':'/entry/ajaxUpdate',
                                                        'data': dataset,
                                                        'cache':false,
                                                        'beforeSend':function() { $(".items").addClass("loading"); },
                                                        'complete':function() { $(".items").removeClass("loading"); },
                                                        'success':function(html){jQuery("#entryList").html(html)}});return false;});

        // Set date in browser using php's date function as the javascript one sucks.
        $('#date-picker').on('change', function() {

            $('body').on('change', '#date-picker', function(){jQuery.ajax({'url':'/entry/formatDate/date/'+ $('#date-picker').val(), 'cache':false,'success':function(html){jQuery('#selected-date').html(html)}});return false;});

        });
    }

    function initNavTabClicks() 
  {

        // Live feed button
        $('body').on('click','#notes-update-not',function(){

            clearDataset();
            jQuery.ajax({'beforeSend':function() { 
                    $(".items").addClass("loading"); 
                },
                'complete':function() { 
                    $(".items").removeClass("loading"); 
                },
                'url':'/note/ajaxUpdate/filter/none',
                'data':dataset,
                'cache':false,
                'success':function(html){
                    jQuery("#entryList").html(html)
                }
            });
        return false;});

        // Completed trades button
        // JAMES
        
        
        
        $('body').on('click','#notes-update',function(){

            addToDataset("filter", 'confirmedTrades'); 
            jQuery.ajax({'beforeSend':function() { 
                    $(".items").addClass("loading"); 
                },
                'complete':function() { 
                    $(".items").removeClass("loading"); 
                },
                'url':'/Notes/ajaxUpdate',
                'data':dataset,
                'cache':false,
                'success':function(html){
                    jQuery("#entryList").html(html)
                }
            });
        return false;});

        // Free agents button
        $('body').on('click','#free-agents-button',function(){

            addToDataset("filter", 'freeAgents'); 
            jQuery.ajax({'beforeSend':function() { 
                    $(".items").addClass("loading"); 
                },
                'complete':function() { 
                    $(".items").removeClass("loading"); 
                },
                'url':'/entry/ajaxUpdate',
                'data':dataset,
                'cache':false,
                'success':function(html){
                    jQuery("#entryList").html(html)
                }
            });
        return false;});
    }

    function initNavTabs() {

        $('#entry-nav li').on('click', function() {

            setActive($(this).attr('id'));
        //    showHideHeader($(this));
        });
    }

    function setActive(el) {

        $('#entry-nav-1').removeClass('active');
        $('#entry-nav-2').removeClass('active');
        $('#entry-nav-3').removeClass('active');

        $('#'+el).addClass('active');

        if(el == 'entry-nav-1') {

            liveFeed = true;
        } else {
        
            liveFeed = false;
        }

        assignArrowClass(el);
    }

    function assignArrowClass(el) {

        $('#arrow').removeClass('livefeed');
        $('#arrow').removeClass('trade');
        $('#arrow').removeClass('freeagent');

        if(el == 'entry-nav-1') $('#arrow').addClass('livefeed');
        if(el == 'entry-nav-2') $('#arrow').addClass('trade');
        if(el == 'entry-nav-3') $('#arrow').addClass('freeagent');
    }

    function showHideHeader(el) {

        if(el.attr('id') == 'entry-nav-1') {

            $('#entry-header').hide();
        } else {

            $('#entry-header').show();
        }
    }

    function initNavTradeTabs() {

        $('#entry-trade-nav li').on('click', function() {

            $('#trade-in').removeClass('active');
            $('#trade-out').removeClass('active');

            $(this).addClass('active');


            if($(this).attr('id') == 'trade-in') {

                jQuery.ajax({
                    'url':'/entry/ajaxUpdateTrades/filter/tradesIn',
                    'cache':false,
                    'success':function(html){
                        jQuery("#tradeList").html(html)
                    },
                    'beforeSend':function() { $(".items").addClass("loading"); },
                    'complete':function() { $(".items").removeClass("loading"); }
                });

                return false;
            }

            if($(this).attr('id') == 'trade-out') {

                jQuery.ajax({
                    'url':'/entry/ajaxUpdateTrades/filter/tradesOut',
                    'cache':false,
                    'success':function(html){
                        jQuery("#tradeList").html(html)
                    },
                    'beforeSend':function() { $(".items").addClass("loading"); },
                    'complete':function() { $(".items").removeClass("loading"); }
                });
                
                return false;
            }

        });

    }
