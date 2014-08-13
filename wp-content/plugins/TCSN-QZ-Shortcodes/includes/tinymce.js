// JavaScript Document
(function () {
    tinymce.create('tinymce.plugins.tcsnshortcodes', {
        /**
         * Initializes the plugin, this will be executed after the plugin has been created.
         * This call is done before the editor instance has finished it's initialization so use the onInit event
         * of the editor instance to intercept that event.
         *
         * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
         * @param {string} url Absolute URL to where the plugin is located.
         */
        init: function (ed, url) {
			
			// Register the command for buttons
            ed.addCommand('tcsnbuttons', function () {
                ed.windowManager.open({
                    file: url + '/button-shortcode-popup.php', // file that contains HTML for modal window
                    width: 500, // size of window
                    height: 400, // size of window
                    inline: 1
                });
            }),

			// Register button for button
            ed.addButton('tcsnbuttons', {
                title: 'Button',
                cmd: 'tcsnbuttons',
                image: url + '/images/icon-sc-btn.png'
            }); 

			// General
			ed.addButton('tcsngeneral', {
				type: 'listbox',
				text: 'General',
				fixedWidth: true,
				icon: false,
				onselect: function(e) {
            		ed.insertContent(this.value());
        		},
		    values: [
				{text: 'Icon - Please refer help doc', value: '[icon type="star" color="#000" size="20px"]'},
				{text: 'Unordered List', value: '[list color="" font_size="" list_style="e.g. square, disc"][list_item]List item one[/list_item][list_item]List item two[/list_item][list_item]List item three[/list_item][/list]'},
				{text: 'Ordered List', value: '[ordered_list color="" font_size="" list_style="e.g. decimal, lower-alpha"][list_item]List item one[/list_item][list_item]List item two[/list_item][list_item]List item three[/list_item][/ordered_list]'},
				{text: 'List - Arrow', value: '[list_arrow color="" font_size=""][list_item]List item one[/list_item][list_item]List item two[/list_item][list_item]List item three[/list_item][/list_arrow]'},
				{text: 'List - Checkmark', value: '[list_checkmark color="" font_size=""][list_item]List item one[/list_item][list_item]List item two[/list_item][list_item]List item three[/list_item][/list_checkmark]'},
				{text: 'List - Star', value: '[list_star color="" font_size=""][list_item]List item one[/list_item][list_item]List item two[/list_item][list_item]List item three[/list_item][/list_star]'},
				{text: 'List - Circle', value: '[list_circle color="" font_size=""][list_item]List item one[/list_item][list_item]List item two[/list_item][list_item]List item three[/list_item][/list_circle]'},
				{text: 'List - Heart', value: '[list_heart color="" font_size=""][list_item]List item one[/list_item][list_item]List item two[/list_item][list_item]List item three[/list_item][/list_heart]'},
				{text: 'List - Pipe Separator', value: '[list_separator color="" font_size=""][list_item]List item one[/list_item][list_item]List item two[/list_item][list_item]List item three[/list_item][/list_separator]'},
				{text: 'List - Inline', value: '[list_inline color="" font_size=""][list_item]List item one[/list_item][list_item]List item two[/list_item][list_item]List item three[/list_item][/list_inline]'},
				{text: 'List - Pricing', value: '[list_pricing][list_item]List item one[/list_item][list_item]List item two[/list_item][list_item]List item three[/list_item][/list_pricing]'},
				{text: 'List - Pricing Head', value: '[list_pricing_thead padding_top="193px"][list_item]List item one[/list_item][list_item]List item two[/list_item][list_item]List item three[/list_item][/list_pricing_thead]'},
				{text: 'tooltip', value: '[tooltip url="" title="Content inside tooltip" placement="e.g. top, bottom, left, right"]Link text[/tooltip]'},
				{text: 'Vertical spacer / gap', value: '[spacer height="in px"]'},
				{text: 'Horizontal spacer / gap', value: '[spacer_wide width="in px"]'},
				{text: 'Table', value: '[table strip="striped" border="bordered" compact="" hover="hover"][thead][tr][th]Heading one[/th][th]Heading two[/th][/tr][/thead][tbody][tr][td]One[/td][td]Two[/td][/tr][tr][td]Three[/td][td]Four[/td][/tr][/tbody][/table]'},
    		],
			
			//onPostRender: function() {
      // Select the second item by default
//    }
			});
			
			// Typography
			ed.addButton('tcsntypo', {
				type: 'listbox',
				text: 'Typography',
				fixedWidth: true,
				icon: false,
				onselect: function(e) {
            		ed.insertContent(this.value());
        		},
		    values: [
				{text: 'Text Style', value: '[text_style size="give like 24px, leave blank for default" line_height="give like 24px, 1.2em, leave blank for default" color=""]Content here[/text_style]'},
				{text: 'Link with Underline', value: '[link_underline color="leave blank for theme default" target="_self" url=""]Link text here[/link_underline]'},
				{text: 'Highlight', value: '[highlight bgcolor="e.g. #000 or green, leave blank for theme default" color="e.g. #fff or green, leave blank for theme default"]Content here[/highlight]'},
				{text: 'Dropcap', value: '[dropcap bg_color="e.g. #000 or green, leave blank for theme default"]T[/dropcap]'},

    		],
			//onPostRender: function() {
      // Select the second item by default
//    }
			});
			
        },
		
        /**
         * Creates control instances based in the incoming name. This method is normally not
         * needed since the addButton method of the tinymce.Editor class is a more easy way of adding buttons
         * but you sometimes need to create more complex controls like listboxes, split buttons etc then this
         * method can be used to create those.
         *
         * @param {String} n Name of the control to create.
         * @param {tinymce.ControlManager} cm Control manager to use inorder to create new control.
         * @return {tinymce.ui.Control} New control instance or null if no control was created.
         */
        createControl : function(n, cm) {
              switch (n) {
				
			// Typography Shortcodes
			case 'tcsntypo':
                var mlb = cm.createListBox('tcsntypo', {
                    title : 'Text Styles',
                    onselect : function(v) {
                       tinyMCE.activeEditor.selection.setContent(v);
                     }
                });

                // Add some values to the list box
				mlb.add('Text Style', '[text_style size="give like 24px, leave blank for default" line_height="give like 24px, 1.2em, leave blank for default" color=""]Content here[/text_style]');
				mlb.add('Link with Underline', '[link_underline color="leave blank for theme default" target="_self" url=""]Link text here[/link_underline]');
				mlb.add('Highlight', '[highlight bgcolor="e.g. #000 or green, leave blank for theme default" color="e.g. #fff or green, leave blank for theme default"]Content here[/highlight]');
				mlb.add('Dropcap', '[dropcap bg_color="e.g. #000 or green, leave blank for theme default"]T[/dropcap]');

				// Return the new listbox instance
            	return mlb;
				
			// General Shortcodes
			case 'tcsngeneral':
                var mlb = cm.createListBox('tcsngeneral', {
                    title : 'General SC',
                    onselect : function(v) {
                       tinyMCE.activeEditor.selection.setContent(v);
                     }
                });

                // Add some values to the list box
				mlb.add('Icon - Please refer help doc', '[icon type="star" color="#000" size="20px"]');
				mlb.add('Unordered List', '[list color="" font_size="" list_style="e.g. square, disc"][list_item]List item one[/list_item][list_item]List item two[/list_item][list_item]List item three[/list_item][/list]');
				mlb.add('Ordered List', '[ordered_list color="" font_size="" list_style="e.g. decimal, lower-alpha"][list_item]List item one[/list_item][list_item]List item two[/list_item][list_item]List item three[/list_item][/ordered_list]');
				mlb.add('List - Checkmark', '[list_checkmark color="" font_size=""][list_item]List item one[/list_item][list_item]List item two[/list_item][list_item]List item three[/list_item][/list_checkmark]');
				mlb.add('List - Arrow', '[list_arrow color="" font_size=""][list_item]List item one[/list_item][list_item]List item two[/list_item][list_item]List item three[/list_item][/list_arrow]');
				mlb.add('List - Star', '[list_star color="" font_size=""][list_item]List item one[/list_item][list_item]List item two[/list_item][list_item]List item three[/list_item][/list_star]');
				mlb.add('List - Circle', '[list_circle color="" font_size=""][list_item]List item one[/list_item][list_item]List item two[/list_item][list_item]List item three[/list_item][/list_circle]');
				mlb.add('List - Heart', '[list_heart color="" font_size=""][list_item]List item one[/list_item][list_item]List item two[/list_item][list_item]List item three[/list_item][/list_heart]');
				mlb.add('List - Pipe Separator', '[list_separator color="" font_size=""][list_item]List item one[/list_item][list_item]List item two[/list_item][list_item]List item three[/list_item][/list_separator]');
				mlb.add('List - Inline', '[list_inline color="" font_size=""][list_item]List item one[/list_item][list_item]List item two[/list_item][list_item]List item three[/list_item][/list_inline]');
				mlb.add('List - Pricing', '[list_pricing][list_item]List item one[/list_item][list_item]List item two[/list_item][list_item]List item three[/list_item][/list_pricing]');
				mlb.add('List - Pricing Head', '[list_pricing_thead padding_top="193px"][list_item]List item one[/list_item][list_item]List item two[/list_item][list_item]List item three[/list_item][/list_pricing_thead]');
				mlb.add('tooltip', '[tooltip url="" title="Content inside tooltip" placement="e.g. top, bottom, left, right"]Link text[/tooltip]');
				mlb.add('Vertical spacer / gap', '[spacer height="in px"]');
				mlb.add('Horizontal spacer / gap', '[spacer_wide width="in px"]');
				mlb.add('Table - Please refer help doc', '[table strip="striped" border="bordered" compact="" hover="hover"][thead][tr][th]Heading one[/th][th]Heading two[/th][/tr][/thead][tbody][tr][td]One[/td][td]Two[/td][/tr][tr][td]Three[/td][td]Four[/td][/tr][/tbody][/table]');

				// Return the new listbox instance
            	return mlb;
        }
        return null;
        },
		
        /**
         * Returns information about the plugin as a name/value array.
         * The current keys are longname, author, authorurl, infourl and version.
         *
         * @return {Object} Name/value array containing information about the plugin.
         */
        getInfo: function () {
            return {
                longname: 'TCSN Shortcodes',
                author: 'Tansh',
                authorurl: 'http://tanshcreative.com',
                infourl: 'http://tanshcreative.com',
                version: tinymce.majorVersion + "." + tinymce.minorVersion
            };
        }
    });

    // Register plugin
    tinymce.PluginManager.add('tcsnshortcodes', tinymce.plugins.tcsnshortcodes);
})();