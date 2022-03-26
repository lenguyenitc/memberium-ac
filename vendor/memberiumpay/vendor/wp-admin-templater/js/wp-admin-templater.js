'use strict';

var $doc = document,
$adminNotice,
wpAdminTmpls = {},
wpAdminInitTmpls = {},
wpAdminUnlocks = {},
wpAdminInitData = {},
wpAdminCodemirrorEditors = {},
wpAdminScreenURI = '',
wpAdminAjaxUrl,
wpatButtons,
wpatChoices;

/**
 * WP Admin Templater
*/
var wpAdminTemplater = function wpAdminTemplater(data) {
    wpatChoices = data.choices ? data.choices : {};
    // Define Props
    var props = {
        prefix      : data.prefix,
        page        : data.page,
        tab         : data.tab,
        tabs        : data.tabs,
        settings    : data.settings,
        I18n        : data.I18n,
        choices     : data.choices,
        ajaxSave    : data.ajax_save,
        uploaders   : {}
    },
    // Define Elements
    $doc = document,
    $body = document.body,
    $adminForm,
    $addNewToggle,
    $addNewForm,
    $filterWrap,
    $tabs,
    $panels,
    $listTable,
    $saveBtn,
    panels = {};
    //Constants
    wpAdminScreenURI = data.screenUri;
    wpAdminAjaxUrl = data.ajaxUrl;
    wpatButtons = ( data.wpat_buttons ) ? data.wpat_buttons : {};

    return {
        props       : props,
        data        : data,
        page        : props.page,
        tab         : props.tab,
        settings    : props.settings,
        choices     : props.choices,
        tableRows   : false,
        I18n        : props.I18n,
        ajaxSave    : ( props.ajaxSave > '' && _.isString(props.ajaxSave) ) ? props.ajaxSave : false,
        els         : {},
        filters     : {},
        init        : function init(props){

            //Generate Underscore Templates Array
            if( this.data.tmpls ){
                _.each( this.data.tmpls, function( tmpl, id ) {
                    if( !wpAdminTmpls.hasOwnProperty(id) ){
                        wpAdminTmpls[id] = wp.template(tmpl);
                    }
                });
            }

            //Set Elements
            $adminForm = $doc.querySelector('.wpat-admin-form[data-screen="'+this.page+'"]');
            $adminForm = ( $adminForm !== null ) ? $adminForm : false;

            //Filter Wrap
            $filterWrap = $doc.querySelector('.wpat-opt-filter');
            $filterWrap = ( $filterWrap !== null ) ? $filterWrap : false;

            //Tabs
            $tabs = ( $adminForm ) ? $adminForm.querySelector('.wpat_option_tabs') : false;

            //Panels
            $panels = ( $adminForm ) ? $adminForm.querySelector('.wpat_option_panels') : false;

            //Check for Ajax Save
            if( $adminForm && this.ajaxSave ){
                this.saveSettingsInt();
            }

            //Add New Form
            if( this.data.add_new_form ){
                $addNewForm = $doc.getElementById(this.data.add_new_form.slug);
                $addNewForm = ( $addNewForm !== null ) ? $addNewForm : false;
                $addNewToggle = $doc.getElementById(this.data.add_new_form.toggle);
                $addNewToggle = ( $addNewToggle !== null ) ? $addNewToggle : false;
            }

            //List Table
            if( this.data.list_table ){
                $listTable = $doc.getElementById(this.data.list_table.slug);
                $listTable = ( $listTable !== null ) ? $listTable : false;
            }
            this.render();
        },
        saveSettingsInt: function saveSettingsInt(){
            $saveBtn = $adminForm.querySelector('.'+this.page+'-submit');
            $saveBtn = ( $saveBtn !== null ) ? $saveBtn : false;
            if( $saveBtn ){
                var thisTemplater = this;
                // Save On Click
                $saveBtn.onclick = function(e){
                    e.preventDefault();
                    var getFormData = wpatGenerateFormData( thisTemplater.settings, $adminForm );
                    if( getFormData.error ){
                        _.each( formData.error, function( error ) {
                            thisTemplater.renderError( error, $editForm );
                        });
                    }
                    else {
                        thisTemplater.renderLoading('Saving Settings', $adminForm);
                        thisTemplater.removeNotice();
                        getFormData.data.action = 'wpat_ajax';
                        getFormData.data.data_name = thisTemplater.ajaxSave;
                        getFormData.data.setting_type = 'option';
                        wpatRequest('POST', getFormData.data, function(response){
                            var data = ( response.data ) ? response.data : {};
                            thisTemplater.removeLoading();
                            if( data.notice ){
                                thisTemplater.renderNotice(data.notice,$adminForm);
                            }
                        });
                    }
                };
            }
        },
        setSetting: function setProp(prop, value){
            this.props[prop] = value;
        },
        setTab: function setTab(tab) {
            this.tab = tab;
        },
        render: function render(props) {
            //Render Tabs
            if( this.data.tabs ){
                this.renderTabs(this.data.tabs);
            }
            //Render Page Level Add New Form
            if( $addNewForm ){
                // Determin Settings
                if( ! this.data.add_new_form.hasOwnProperty('settings') ){
                    this.data.add_new_form.settings = _.clone(this.data.settings);
                }
                this.renderAddNewForm(this.data.add_new_form, $addNewForm, $addNewToggle);
            }
            //Generate List Table
            if( $listTable ){
                this.renderListTable(this.data.list_table, $listTable);
            }
        },
        renderTabs: function renderTabs( tabs ){
            var thisTemplater = this,
            activeTab = this.data.tab,
            activeTabExists = false;

            if( $tabs ){
                $tabs.innerHTML = wpAdminTmpls.tabs( {
                    lis         : this.data.tabs,
                    activeTab   : activeTab,
                } );
            }
            if( $panels ){
                _.each( this.data.tabs, function( tab, t ) {
                    var panelData = wpatTabPanelData(tab, data),
                    panelID = '#'+tab.slug+'_options_data',
                    isActive = ( tab.slug === activeTab ) ? true : false;
                    // Tab has no content
                    if( ! panelData.content > '' ){
                        //Remove <li> Tab
                        $tabs.querySelector('a[href="'+panelID+'"]').parentNode.remove();
                        activeTabExists = (isActive) ? false : activeTabExists;
                    }
                    else {
                        panels[t] = {
                            id   : '#'+tab.slug+'_options_data',
                            slug : tab.slug,
                            data : panelData
                        };
                        thisTemplater.renderPanel(tab, t);
                        activeTabExists = (isActive) ? true : activeTabExists;
                    }
                });
                //Active Tab Doesn't exist
                if( !activeTabExists ){
                    //Set first tab as active and update URL
                    var key = Object.keys(panels)[0];
                    panels[key].$btn.parentNode.classList.add('active');
                    panels[key].$panel.classList.add('active');
                    window.history.pushState(null,null, panels[key].url);
                    thisTemplater.setTab(panels[key].slug);
                }
                //Apply Single Tab Class
                if( $tabs.getElementsByTagName("li").length < 2 ){
                    $tabs.classList.add('single');
                }
            }
        },
        renderPanel: function renderPanel( tab, t ){
            var thisTemplater = this;
            $panels.insertAdjacentHTML('beforeend', wpAdminTmpls.panel( panels[t].data ) );
            panels[t].$btn = $tabs.querySelector('a[href="'+panels[t].id+'"]');
            panels[t].$panel = $panels.querySelector(panels[t].id);
            panels[t].url = wpAdminScreenURI + '&tab=' + panels[t].slug;

            //On Click
            panels[t].$btn.onclick = function(e){
                e.preventDefault();
                var $li = panels[t].$btn.parentNode;
                if( !wpatAdminHasClass( $li, 'active') ){
                    $tabs.querySelector('.active').classList.remove('active');
                    $panels.querySelector('.active').classList.remove('active');
                    $li.classList.add('active');
                    panels[t].$panel.classList.add('active');
                    window.history.pushState(null,null, panels[t].url);
                    thisTemplater.setTab(panels[t].slug);
                }
            }

            // Save Panel
            if( tab.hasOwnProperty('save') ){

                panels[t].$save = panels[t].$panel.querySelector('.wpat-action-row .button-save');
                panels[t].$save.onclick = function(e){
                    e.preventDefault();
                    var panelSections = wpatPanelSections(tab.slug, thisTemplater.data),
                    settings = _.flatten(_.map(panelSections, 'settings')),
                    panelData = wpatGenerateFormData( settings, panels[t].$panel );
                    if( panelData.error ){
                        _.each( formData.error, function( error ) {
                            thisTemplater.renderError( error, $editForm );
                        });
                    }
                    else {
                        thisTemplater.renderLoading('Saving Settings', panels[t].$panel);
                        thisTemplater.removeNotice();
                        panelData.data.action = 'wpat_ajax';
                        panelData.data.data_name = tab.save;
                        panelData.data.page = thisTemplater.page;
                        panelData.data.tab = tab.slug;
                        panelData.data.operation = 'save';
                        wpatRequest('POST', panelData.data, function(response){
                            var data = ( response.data ) ? response.data : {};
                            thisTemplater.removeLoading();
                            if( data.notice ){
                                thisTemplater.renderNotice(data.notice, panels[t].$panel);
                            }
                            // Check for custom function
                            if( data.data.callback ){
                                var func = data.data.callback;
                                if (typeof thisTemplater.filters[func] === "function") {
                                    thisTemplater.filters[func](data.data);
                                }
                            }
                        });
                    }
                    return false;
                };
            }
            if( tab.hasOwnProperty('delete') ){
                panels[t].$delete = panels[t].$panel.querySelector('.wpat-action-row .button-delete');
                panels[t].$delete.onclick = function(e){
                    e.preventDefault();
                    var tabLabel = tab.label,
                    confirmation = confirm( thisTemplater.I18n.confirm_delete + ' ' + tabLabel + '?');
                    if(confirmation){
                        thisTemplater.renderLoading('Deleting Settings', panels[t].$panel);
                        thisTemplater.removeNotice();
                        var deleteData = {
                            action:'wpat_ajax',
                            data_name:tab.delete,
                            page:thisTemplater.page,
                            tab:tab.slug,
                            operation:'delete'
                        };
                        wpatRequest('POST', deleteData, function(response){
                            var data = ( response.data ) ? response.data : {};
                            thisTemplater.removeLoading();
                            if( data.notice ){
                                thisTemplater.renderNotice(data.notice, panels[t].$panel);
                            }
                            // Check for custom function
                            if( data.data.callback ){
                                var func = data.data.callback;
                                if (typeof thisTemplater.filters[func] === "function") {
                                    thisTemplater.filters[func](data.data);
                                }
                            }
                        });
                    }
                    return false;
                };
            }
            //Initialze Functional Settings
            this.initTmpls($panels);
        },
        renderAddNewForm: function renderAddNewForm( newForm, $form, $toggle ){
            var thisTemplater = this,
                $formWrap = $form.closest('.wpat-add-new-form-wrap'),
                newFormData = _.clone( newForm ),
                dataName = newFormData.data_name,
                newFormSections = wpatPanelSections(dataName, newFormData),
                choices = this.choices;

            // Renders Edit Form
            newFormData.content = wpatSectionsContent(newFormSections);
            $form.insertAdjacentHTML('beforeend', wpAdminTmpls.panel(newFormData));
            $form.insertAdjacentHTML('beforeend', wpatActionRow(['cancel','add_new']));

            //Initialze Functional Settings
            this.initTmpls($form);

            // Toggle Form
            $toggle.onclick = function(e){
                e.preventDefault();
                thisTemplater.removeNotice();
                wpatToggleAria( $toggle, 'expanded' );
                wpatToggleAria( $formWrap, 'hidden' );
                wpatAddNewReset( $form, newFormSections );
                wpatReinitSelect2($form, '.wpalSelect2-hidden-accessible', choices, thisTemplater);
                return false;
            };

            // Cancel Toggle
            $form.querySelector('.button-cancel').onclick = function(e){
                e.preventDefault();
                $toggle.click();
                return false;
            };

            // Add New Ajax
            if( dataName ){
                $form.querySelector('.button-add-new').onclick = function(e){
                    e.preventDefault();
                    //check for custom function?
                    var $parent = $doc.getElementById('wpbody-content'),
                        settings = _.flatten(_.map(newFormSections, 'settings')),
                        getFormData = wpatGenerateFormData( settings, $form );
                    if( getFormData.error ){
                        _.each( getFormData.error, function( error ) {
                            thisTemplater.renderError( error, $parent );
                        });
                    }
                    else {
                        thisTemplater.renderLoading('Saving Settings', $form);
                        thisTemplater.removeNotice();
                        getFormData.data.action = 'wpat_ajax';
                        getFormData.data.data_name = newFormData.data_name;
                        getFormData.data.operation = 'add_new';
                        wpatRequest('POST', getFormData.data, function(response){

                            var data = ( response.data ) ? response.data : {};
                            thisTemplater.removeLoading();
                            if( data.notice ){
                                thisTemplater.renderNotice(data.notice, $parent);
                            }
                            $toggle.click();
                            if( data.data.list_table ){
                                thisTemplater.renderListTable(data.data.list_table);
                            }
                            // Check for custom function
                            if( data.data.callback ){
                                var func = data.data.callback;
                                if (typeof thisTemplater.filters[func] === "function") {
                                    thisTemplater.filters[func](data.data);
                                }
                            }
                        });
                    }
                    return false;
                };
            }

        },
        renderListTable: function renderListTable( tableData ){

            tableData = _.clone(tableData);
            var $table = $doc.getElementById(tableData.slug),
            tbodys = tableData.hasOwnProperty('tbodys') ? tableData.tbodys : false;
            $table = ( $table !== null ) ? $table : false;
            //Render Filters
            if(tbodys){
                tableData.rows = _.sortBy(tableData.rows, tbodys);
            }
            tableData = this.renderTableFilters(tableData);
            //Conditional Data Filter Function For Display
            if( tableData.data_filter ){
                var filter = tableData.data_filter;
                if (typeof this.filters[filter] === "function") {
                    tableData = this.filters[filter]( tableData );
                }
            }
            //Add Table Content
            $table.innerHTML = wpAdminTmpls.list_table( tableData );
            //Render Actions
            this.renderTableActions( $table, tableData );
            //Initialze Functional Settings
            this.initTmpls($table);
        },
        renderTableFilters:function renderTableFilters(filterData){

            var filters = ( filterData.filters ) ? filterData.filters : false;
            if( filters ){
                //Add Common Filter Button
                if( wpatIndexOf( filters, 'slug', 'filter_submit' ) < 0 ){
                    filters.push({
                        slug : 'filter_submit',
                        type : 'button',
                        title : this.I18n.filter,
                        attrs : [
                            { 'prop' : 'class',  'value' : 'button wpat_list_table_filter'}
                        ]
                    });
                }
                _.each( filterData.filters, function( filter, f ) {
                    filterData.filters[f].content = wpatSetting( filter );
                });
            }
            return filterData;
        },
        renderTableActions:function renderTableActions( $table, tableData ){
            //Init Action Buttons
            var thisTemplater = this,
                actionBtns = $table.querySelectorAll('.row-actions a[data-action]');
            _.each( actionBtns, function( $btn, b ) {
                $btn.onclick = function(e){
                    e.preventDefault();
                    thisTemplater.removeNotice();
                    var action = $btn.getAttribute('data-action'),
                        id = $btn.getAttribute('data-id');
                    switch (action) {
                        case 'delete':
                            thisTemplater.deleteTableRow( tableData, id );
                        break;
                        case 'edit':
                            thisTemplater.renderEditForm( tableData, id );
                        break;
                        default:
                            // Allow dynamic function calls
                            if (typeof thisTemplater.filters[action] === "function") {
                                thisTemplater.filters[action](tableData, id, $btn);
                            }
                        break;
                    }
                    return false;
                };
            });
            //Init Filter Button
            if( tableData.filters ){
                var $parent = $table.parentNode,
                    $filterBtn = $parent.querySelector('.wpat_list_table_filter');
                if( $filterBtn ){
                    $filterBtn.onclick = function(e){
                        e.preventDefault();
                        thisTemplater.filterTableData( $table, tableData );
                        return false;
                    }
                }
            }
        },
        filterTableData:function ( $table, tableData ){
            var thisTemplater = this,
                $parent = $table.parentNode,
                searchFilters = {},
                tableRows = tableData.unfiltered,
                searchRows = _.clone(tableRows),
                filters = (tableData.filters) ? tableData.filters : false,
                searchField = ( tableData.search_input ) ? tableData.search_input : false,
                $searchField = (searchField) ? $parent.querySelector(searchField) : false,
                searchString = ( $searchField.length && $searchField.value ) ? $searchField.value : '';
            if( searchString > '' ){
                //todo more dynamic not all searches will be done only on name
                //searchRows = wpatNameLike( searchRows, searchString );
                //tableData.search_string = searchString;
            }
            if(filters){
                _.each( filters, function( filter, f ) {
                    if( filter.slug != 'filter_submit' ){
                        var $el = $parent.querySelector('#'+filter.slug);
                        if( $el.value > '' ){
                            searchFilters[filter.column] = $el.value;
                        }
                        tableData.filters[f].value = $el.value;
                    }
                });
            }
            if( _.isEmpty(searchFilters) ){
                tableData.rows = tableData.unfiltered;
                thisTemplater.renderListTable(tableData);
            }
            else{
                tableData.rows = wpatNestedFilter( searchRows, searchFilters );
                thisTemplater.renderListTable(tableData);
            }
        },
        renderEditForm:function ( tableData, id ){
            var thisTemplater = this,
                tableRows = tableData.rows,
                dataName = tableData.data_name,
                editFilter = ( tableData.hasOwnProperty('edit_filter') ) ? tableData.edit_filter : '',
                idProp = ( tableData.row_id_prop ) ? tableData.row_id_prop : 'id',
                rowIndex = wpatIndexOf( tableRows, idProp, id ),
                rowData = tableRows[rowIndex],
                settings = { settings : tableData.edit_form },
                editSections = wpatPanelSections(dataName,settings),
                $row = $doc.getElementById('wpat_row_id_'+id),
                columns = ( tableData.columns ) ? tableData.columns : {},
                colspan = ( tableData.colspan ) ? tableData.colspan : _.size(columns),
                showCb = ( parseInt(tableData.show_cb) > 0 ) ? true : false,
                editSettings = [],
                hasEditors = [],
                rowSettings = [],
                rowClassName = '';
                colspan = ( showCb ) ? colspan + 1 : colspan;

            _.each( editSections, function( section, index ) {
                editSettings.push({
                    slug:section.slug,
                    label:section.title,
                    type:section.type,
                    desc:(section.desc) ? section.desc : ''
                });
                var rowSettings = _.clone(editSections[index].settings);
                _.each( rowSettings, function( setting, s ) {
                    var slug = setting.slug;
                    //todo review : filter for slug to check for db_column or setting name?
                    if( rowData.hasOwnProperty( 'class' ) ){
                        rowClassName = rowData.class;
                    }
                    if( setting.type === 'editor' ){
                        setting.id = slug + '-' + rowIndex;
                        hasEditors.push(setting.id);
                    }
                    if( rowData && rowData.hasOwnProperty( slug ) ){
                        rowSettings[s].value = rowData[slug];
                    }
                    editSettings.push({
                        slug:rowSettings[s].slug,
                        label:setting.title,
                        type:setting.type,
                        tooltip:(setting.tooltip) ? setting.tooltip : false,
                        tooltip_title:wpatTooltipTitle( setting ),
                        help_id:(setting.help_id) ? setting.help_id : 0,
                        settings:rowSettings[s],
                        content:wpatSetting(rowSettings[s]),
                        desc:(setting.desc) ? setting.desc : '',
                    });
                });
            });

            var editData = {
                colspan   :   colspan,
                id        :   id,
                confirm   :   '',
                settings  :   editSettings,
                I18n      :   this.data.I18n,
                className :   rowClassName
            };
            // Allow Edit Row Data Filter
            if( editFilter > '' ){
                if (typeof thisTemplater.filters[editFilter] === "function") {
                    editData = thisTemplater.filters[editFilter](editData, rowData, tableData);
                }
            }

            // Insert Edit Row
            $row.insertAdjacentHTML('afterend', wpAdminTmpls.list_table_edit(editData) );

            // Hide Current Row
            $row.style.display = 'none';

            var $editForm = $doc.getElementById('wpat_form_id_'+id);

            // Initialize Functional Settings
            this.initTmpls($editForm);

            var $hidden = $doc.getElementById('wpat_row_id_'+id+'_hidden'),
                $edit = $doc.getElementById('wpat_row_id_'+id+'_edit'),
                $cancel = $edit.querySelector('.inline-edit-save .cancel'),
                $save = $edit.querySelector('.inline-edit-save .save'),
                $parent = $doc.getElementById('wpbody-content');

            // Cancel Edits
            $cancel.onclick = function(e){
                e.preventDefault();
                $row.style.display = null;
                $hidden.parentNode.removeChild($hidden);
                $edit.parentNode.removeChild($edit);
                // Manage Editors
                if( ! _.isEmpty(hasEditors) ){
                    _.each( hasEditors, function( editor ) {
                        wp.editor.remove(editor);
                    });
                }
                return false;
            };

            // Save Edits
            $save.onclick = function(e){
                e.preventDefault();
                var formData = wpatGenerateFormData(editSettings, $editForm);
                if( formData.error ){
                    _.each( formData.error, function( error ) {
                        thisTemplater.renderError( error, $editForm );
                    });
                }
                else {
                    formData.data.row_id = id;
                    formData.data.action = 'wpat_ajax';
                    formData.data.data_name = dataName;
                    formData.data.operation = 'edit';

                    var confirmFilter = $save.getAttribute('data-confirm'),
                        confirmed = true;
                    if( confirmFilter ){
                        if (typeof thisTemplater.filters[confirmFilter] === "function") {
                            confirmed = thisTemplater.filters[confirmFilter](formData.data, tableData);
                        }
                    }
                    if( confirmed ){
                        wpatRequest('POST', formData.data, function(response){
                            var data = ( response.data ) ? response.data : {};
                            //thisTemplater.removeLoading();
                            if( data.notice ){
                                thisTemplater.renderNotice(data.notice, $parent);
                            }
                            if( data.data.list_table ){
                                // Manage Editors
                                thisTemplater.renderListTable(data.data.list_table);
                                if( ! _.isEmpty(hasEditors) ){
                                    _.each( hasEditors, function( editor ) {
                                        wp.editor.remove(editor);
                                    });
                                }
                            }
                            else {
                                $cancel.click();
                            }
                        });
                    }
                }
            };
        },
        deleteTableRow:function deleteTableRow( tableData, id ){
            var thisTemplater = this,
                tableRows = tableData.rows,
                idProp = ( tableData.row_id_prop ) ? tableData.row_id_prop : 'id',
                rowIndex = wpatIndexOf( tableRows, idProp, id ),
                rowData = tableRows[rowIndex],
                nameProp = ( tableData.row_name_prop ) ? tableData.row_name_prop : 'name',
                name = rowData[nameProp],
                postID = ( tableData.hasOwnProperty('post_id') ) ? tableData.post_id : false,
                confirmation = confirm( this.I18n.confirm_delete + ' ' + name + '?');
            if(confirmation){
                var deleteData = {
                    action      : 'wpat_ajax',
                    data_name   : tableData.data_name,
                    row_id      : id,
                    operation   : 'delete'
                };
                if( postID ){
                    deleteData.post_id = postID;
                }
                wpatRequest('POST', deleteData, function(response){
                    var data = ( response.data ) ? response.data : {};
                    //thisTemplater.removeLoading();
                    if( data.notice ){
                        var $parent = $doc.getElementById('wpbody-content');
                        thisTemplater.renderNotice(data.notice, $parent);
                    }
                    if( data.data.list_table ){
                        thisTemplater.renderListTable(data.data.list_table);
                    }
                });
            }
        },
        registerFilters:function registerFilters(slug,func){
            this.filters[slug] = func;
        },
        renderLoading:function renderLoading(msg, $el){
            //Display Preloader
            $el.insertAdjacentHTML('afterbegin', wpAdminTmpls.loader({
                msg : msg
            }));
            this.els.$preloader = $el.querySelector('.wpat_overlay');
        },
        removeLoading:function removeLoading(){
            var thisTemplater = this;
            setTimeout(function(){
                thisTemplater.els.$preloader.remove();
                delete thisTemplater.els.$preloader;
            }, 1000);
        },
        renderNotice:function renderNotice(params, $parent){
            //Add Notice Wrap if it doesn't exist
            if( !$adminNotice ){
                $adminNotice = $parent.querySelector('.wpat_notice_wrap');
                $adminNotice = ( $adminNotice !== null ) ? $adminNotice : false;
                if(!$adminNotice){
                    $adminNotice = document.createElement("div");
                    $adminNotice.classList.add('wpat_notice_wrap');
                    $parent.insertBefore($adminNotice, $parent.firstChild);
                    $adminNotice = $parent.querySelector('.wpat_notice_wrap');
                }
            }
            //Add Template To Wrap
            $adminNotice.innerHTML = wpAdminTmpls.notice(params);
            $adminNotice.scrollIntoView();
            //Add Dismiss Functionality
            if(params.dismissable){
                var thisTemplater = this;
                $adminNotice.querySelector('.notice-dismiss').onclick = function(e) {
                    thisTemplater.removeNotice();
                }
            }
        },
        removeNotice:function removeNotice(){
            if( $adminNotice ){
                $adminNotice.innerHTML = '';
            }
        },
        renderError:function renderError( error, $parent ){

            var $small = document.createElement("SMALL"),
            $field = error.$field,
            $label = $field.parentNode,
            slug = ( error.error && error.error > '' ) ? error.error : '',
            msg = ( error.msg && error.msg > '' ) ? error.msg : '';
            if( error.msg && error.msg > '' ){
                msg = error.msg;
            }
            else if( slug === 'error-min-date' ){
                msg = wpatSprintF(this.I18n['error-min-date'], [$field.getAttribute('min')]);
            }
            else if( slug === 'error-max-date' ){
                msg = wpatSprintF(this.I18n['error-max-date'], [$field.getAttribute('max')]);
            }
            else if( this.I18n['error-'+slug] ){
                msg = this.I18n['error-'+slug];
            }
            else{
                msg = this.I18n['error-generic'];
            }
            $small.className = 'wpat-error';
            $small.innerHTML = msg;
            $label.insertBefore($small, $field.nextSibling);
            $label.classList.add('wpat-error');

            $field.onfocus = function(){
                $label.classList.remove('wpat-error');
                $small.remove();
            };

        },
        initTmpls:function initTmpls($parent){
            wpatInitTmpls( wpAdminInitTmpls, {
                choices         : this.choices,
                editor_config   : this.data.editor_config
            }, $parent, this );
            wpAdminInitTmpls = {};
            wpatInitUnlocks( wpAdminUnlocks, $parent );
        },
        renderUploader:function renderUploader( $wrapper, config ){
            var thisTemplater = this,
            id = $wrapper.id,
            $parent = $wrapper.parentNode,
            $button = $wrapper.querySelector('.wpat-media-uploader-button'),
            media = window.wp.media({
                // todo more dynamic settings
                title: 'Insert image',
                library : {
                    type : 'image'
                },
                button: {
                    text: 'Use this image'
                },
                multiple: false
            });
            $button.onclick = function(e){
                e.preventDefault();
                media.open();
            };
            if( config.src > '' ){
                var $remove = $wrapper.querySelector('.wpat-remove-image');
                $remove.onclick = function(e){
                    e.preventDefault();
                    config.src = '';
                    config.value = '';
                    $parent.innerHTML = wpAdminTmpls.media_uploader(config);
                    $wrapper = $parent.querySelector('#'+id);
                    thisTemplater.renderUploader($wrapper,config);
                }
            }
            media.on( 'select', function() {
                //todo handle multiple files / other types eventually
                var selected = media.state().get( 'selection' ).toJSON();
                config.src = selected[0].url;
                config.value = selected[0].id;
                $parent.innerHTML = wpAdminTmpls.media_uploader(config);
                $wrapper = $parent.querySelector('#'+id);
                thisTemplater.renderUploader($wrapper,config);
            });
        }
    };
};

/**
 * Generate Settings For Tab
*/
var wpatTabPanelData = function ( tab, data ) {
    tab.activeTab = data.tab;
    tab.content = '';
    tab.sections = wpatPanelSections( tab.slug, data );
    if( tab.sections ){
        tab.content += wpatSectionsContent(tab.sections);
    }
    var actions = [];
    if( tab.hasOwnProperty('save') ){
        actions.push('save');
    }
    if( tab.hasOwnProperty('delete') ){
        actions.push('delete');
    }
    if( actions.length ){
        tab.content += wpatActionRow(actions);
    }
    return tab;
};

/**
 * Filter Sections For Tab
*/
var wpatPanelSections = function ( slug, data ) {

    //Filter Sections For Tab
    var sections = {};
    sections = _.filter(data.settings, function (setting, s) {
        return ( setting.tab === slug && setting.type === 'section'  ) ? setting : null;
    });
    sections = wpatPriority( sections );
    //Filter Settings For Each Section
    if( sections ){
        var i = 0;
        _.each( sections, function( section, s ) {
            var settings = {};
            settings = _.filter(data.settings, function (setting, s) {
                return ( setting.tab === slug && setting.section === section.slug ) ? settings[i++] = setting : null;
            });
            sections[s].settings = wpatPriority( settings );
        });
    }
    return sections;
};

/**
 * Section Content
*/
var wpatSectionsContent = function ( sections ) {
    var content = '';
    _.each( sections, function( section ) {
        if( section.settings.length > 0 ){
            section.content = '';
            if( section.tmpl ){
                section.content += wpatRender( section );
            }
            else {
                _.each( section.settings, function( settings ) {
                    if( settings.tmpl ){
                        section.content += wpatRender( settings );
                    }
                    else {
                        section.content += wpatSettingRow( settings );
                    }
                });
            }
            content += wpAdminTmpls.section(section);
            //Check for Callbacks
            if( section.callback ){
                wpAdminInitTmpls[section.slug] = section.callback;
            }
        }
    });
    return content;
};

/**
 * Render A Setting's Row
*/
var wpatSettingRow = function ( setting ){

    return wpAdminTmpls.row({
        slug:setting.slug,
        type:setting.type,
        label:setting.title,
        tooltip:(setting.tooltip) ? setting.tooltip : false,
        tooltip_title:wpatTooltipTitle( setting ),
        help_id:(setting.help_id) ? setting.help_id : 0,
        content:wpatSetting(setting),
        doc_url:'#',
        //doc_url:wpat_admin_data.doc_url,
        desc:(setting.desc) ? setting.desc : ''
    });
};

/**
 * Render A Template
*/
var wpatRender = function ( settings ){

    // Add To Global Templates
    if( !wpAdminTmpls.hasOwnProperty(settings.tmpl) ){
        wpAdminTmpls[settings.tmpl] = wp.template(settings.tmpl);
    }

    //Check for Callbacks for global Inits
    if( settings.callback ){
        wpAdminInitTmpls[settings.slug] = settings.callback;
    }

    return wpAdminTmpls[settings.tmpl](settings);
};

/**
 * Render A Setting
*/
var wpatSetting = function ( setting ){
    var html = '',
    type = setting.type,
    slug = setting.slug,
    default_val = ( typeof setting.default === 'undefined' ) ? '' : setting.default,
    unlock = ( typeof setting.unlock === 'undefined' ) ? false : setting.unlock,
    callback = ( typeof setting.callback === 'undefined' ) ? false : setting.callback,
    webhook = ( typeof setting.webhook === 'undefined' ) ? false : setting.webhook;
    setting.settings = {};
    switch (type) {
        case 'text':
            html += setting.text;
            break;
        case 'switch':
        case 'checkbox':
            if (typeof setting.value === 'undefined') {
                setting.value = default_val;
            }
            setting.settings.css_id = slug;
            setting.settings.css_class = '';
            setting.settings.name = slug;
            setting.settings.checked = ( parseInt(setting.value) > 0 ) ? 1 : 0;
            setting.settings.on = ( setting.on ) ? setting.on : 'On';
            setting.settings.off = ( setting.off ) ? setting.off : 'Off';
            if( setting.disabled ){
                setting.settings.disabled = setting.disabled;
            }
            if(unlock){
                wpAdminUnlocks[slug] = unlock;
            }
            html += wpAdminTmpls.switch( setting.settings );
            break;
        case 'switch_group':
            if (typeof setting.value === 'undefined') {
                setting.value = default_val.split(',');
            }
            var choices = wpatChoices[setting.choices],
                value   = setting.value > '' ? setting.value.split(',') : [];
            html += '<div class="wpat-switch_group-wrap" id="'+slug+'">';
            for( var c in choices ){
                var choice = choices[c].id,
                    id     = slug + "-" + choice,
                    itemSetting = {
                        name    : slug + "["+choice+"]",
                        checked : value.indexOf(choice) !== -1 ? 1 : 0,
                        css_id  : id,
                    };
                    html += '<div class="wpat-switch_group-item" data-switch_group="'+id+'">';
                    html += '<label for="'+id+'"><span>'+choice+'</span></label>';
                    html += wpAdminTmpls.switch( itemSetting );
                    html += '</div>';
            }
            html += '</div>';
            break;
        case 'input':
        case 'readonly':
        case 'display_input':
        case 'number':
        case 'price':
        case 'email':
        case 'hidden':
        case 'password':
        case 'datepicker':
        case 'datetime':

            var inputValue =  ( setting.value ) ? setting.value : default_val;
            if( type === 'datetime' ){
                var timestamp = wpatTimestampArray( inputValue );
                inputValue = timestamp.year + '-' + timestamp.month + '-' + timestamp.day;
            }
            setting.settings.id = 0;
            setting.settings.inputAttr = [
              { prop: 'id', value : slug },
              { prop: 'name', value : slug },
              { prop: 'value', value : inputValue },
              { prop: 'class', value : ( setting.class ) ? setting.class : 'widefat' }
            ];
            var input_type = 'text';
            if( type === 'number' || type === 'price' ){
              input_type = 'number';
              if( setting.min != null ){
                  setting = wpatAttr(setting, 'min', setting.min);
              }
              if( setting.max != null ){
                  setting = wpatAttr(setting, 'max', setting.max);
              }
              if( setting.step != null ){
                  setting = wpatAttr(setting, 'step', setting.step);
              }
              else if( type === 'price' ){
                  setting = wpatAttr(setting, 'step', 'any');
              }
              if( setting.units ){
                  setting = wpatAttr(setting, 'data-wpat-units', setting.units);
              }
            }
            else if( type === 'hidden' || type === 'password' ){
              input_type = type;
            }
            else if( type === 'datepicker' || type === 'datetime' ){
                if( setting.min != null ){
                    setting = wpatAttr(setting, 'min', setting.min);
                }
                if( setting.max != null ){
                    setting = wpatAttr(setting, 'max', setting.max);
                }
                // Datetime add data attribute for reference
                if( type === 'datetime' ){
                    setting = wpatAttr(setting, 'data-wpat-datetime', 1);
                }
                //Check if date is supported
                if( wpatDateSupported() ){
                    input_type="date";
                }
                else{
                    setting = wpatAttr(setting, 'pattern', wpatDatePattern());
                    setting = wpatAttr(setting, 'placeholder', "YYYY-MM-DD");
                }
            }
            else if( type === 'readonly' ){
                setting = wpatAttr(setting, 'readonly', true);
            }
            setting = wpatAttr(setting, 'type', input_type);

            if( setting.required ){
                setting = wpatAttr(setting, 'required', true);
            }

            if( setting.attrs ){
               setting.settings.inputAttr = _.uniq(_.union(setting.attrs, setting.settings.inputAttr), false, _.property('prop'));
            }
            html += wpAdminTmpls.input( setting.settings );
            if( setting.units ){
                html += '<span class="wpat-units">'+setting.units+'</span>';
            }
            if( type === 'datetime' ){
                html += ' @ ';
                // Add Hour
                html += wpAdminTmpls.input({
                    wrapEl : 'span',
                    wrapElClass : 'wpat-hour',
                    inputAttr : [
                        { prop : 'type', value : 'number' },
                        { prop : 'placeholder', value : 'h' },
                        { prop : 'id', value : slug + '_hours' },
                        { prop : 'name', value : slug + '_hours' },
                        { prop : 'min', value : 0 },
                        { prop : 'max', value : 23 },
                        { prop : 'step', value : 1 },
                        { prop : 'pattern', value : '([01]?[0-9]{1}|2[0-3]{1})' },
                        { prop : 'value', value : timestamp.hours }
                    ]
                });
                html += ' : ';
                // Add Minute
                html += wpAdminTmpls.input({
                    wrapEl : 'span',
                    wrapElClass : 'wpat-minute',
                    inputAttr : [
                        { prop : 'type', value : 'number' },
                        { prop : 'placeholder', value : 'm' },
                        { prop : 'name', value : slug + '_minutes' },
                        { prop : 'name', value : slug + '_minutes' },
                        { prop : 'min', value : 0 },
                        { prop : 'max', value : 59 },
                        { prop : 'step', value : 1 },
                        { prop : 'pattern', value : '[0-5]{1}[0-9]{1}' },
                        { prop : 'value', value : timestamp.minutes },
                    ]
                });
            }

            if( setting.callback ){
                wpAdminInitTmpls[slug] = setting.callback;
                wpAdminInitData[slug] = setting;
            }

            break;
        case 'multi_select':
        case 'select':
            setting.settings.inputAttr = [
                { prop: 'id', value : slug },
                { prop: 'type', value : 'text' },
                { prop: 'name', value : slug },
                { prop: 'value', value : ( setting.value ) ? setting.value : default_val },
                { prop: 'data-choices', value : setting.choices },
            ];
            if( type === 'multi_select' ){
                setting = wpatAttr(setting, 'data-multiple', 'true');
            }
            if( setting.search && setting.search === 'no' ){
                setting = wpatAttr(setting, 'data-disable-search', 'true');
            }
            if( setting.clear ){
                var clear = ( setting.clear === 'yes' || setting.clear === 1 ) ? true : false;
                setting = wpatAttr(setting, 'data-allow-clear', clear);
            }
            if( callback ){
                setting = wpatAttr(setting, 'data-callback', callback);
                callback = false;
            }
            if( setting.change ){
                setting = wpatAttr(setting, 'data-change', setting.change);
            }
            if( setting.sortable ){
                if( setting.sortable === 1 || setting.sortable === 'yes' ){
                    setting = wpatAttr(setting, 'data-sortable', true);
                }
            }
            if( setting.html_label ){
                if( setting.html_label === 'yes' || setting.html_label === 1 ){
                    setting = wpatAttr(setting, 'data-allow-html', 1);
                }
            }
            if( setting.placeholder && setting.placeholder > '' ){
                setting = wpatAttr(setting, 'data-placeholder', setting.placeholder);
            }
            if( setting.required ){
                setting = wpatAttr(setting, 'required', true);
            }
            if( setting.attrs ){
                setting.settings.inputAttr = _.uniq(_.union(setting.attrs, setting.settings.inputAttr), false, _.property('prop'));
            }
            html += wpAdminTmpls.input( setting.settings );
            wpAdminInitTmpls[slug] = type;
          break;
        case 'textarea':
        case 'editor':
        case 'editor-html':
        case 'editor-css':
        case 'editor-js':
            var setting_id = ( setting.id ) ? setting.id : slug;
            setting.settings.css_id = setting_id;
            setting.settings.name = slug;
            setting.settings.rows = ( setting.rows ) ? setting.rows : 5;
            setting.settings.content = ( setting.value ) ? setting.value : default_val;
            html += wpAdminTmpls.textarea( setting.settings );
            if( type != 'textarea' ){
                wpAdminInitTmpls[setting_id] = type;
                if( setting.config ){
                    wpAdminInitData[setting_id] = setting.config;
                }
                else if( type === 'editor' && setting.hasOwnProperty('media') ){
                    wpAdminInitData[setting_id] = 'media';
                }
            }
            break;
        case 'button':
            setting.settings.attrs = setting.attrs;
            setting.settings.label = (setting.label) ? setting.label : setting.title;
            html += wpAdminTmpls.button( setting.settings );
            break;
        case 'link':
            setting.settings.attrs = setting.attrs;
            setting.settings.label = (setting.label) ? setting.label : setting.title;
            setting.settings.el = 'a';
            html += wpAdminTmpls.button( setting.settings );
            break;
        case 'table':
            var tableSlug = setting.data.slug;
            html += '<div id="'+tableSlug+'" class="wpat_results_table"></div>';
            wpAdminInitTmpls[tableSlug] = type;
            wpAdminInitData[tableSlug] = setting.data;
            break;
        case 'add_new_form':
            var formSlug = setting.slug;
            //todo - add as underscore tmpl
            html += '<div class="wpat-add-new-form-wrap" aria-hidden="true">';
                html += '<div class="wpat-add-new-form-wrap-inner">';
                    html += '<div id="'+formSlug+'" class="wpat-add-new-form"></div>';
                html += '</div>';
            html += '</div>';
            wpAdminInitTmpls[formSlug] = type;
            wpAdminInitData[formSlug] = setting;
            break;
        case 'media-uploader':
            var media_obj = ( setting.value ) ? setting.value : {};
            setting.settings.css_id = slug;
            setting.settings.name = slug;
            setting.settings.src = ( media_obj.src ) ? media_obj.src : '';
            setting.settings.value = ( media_obj.id ) ? media_obj.id : '';
            //todo dynamic text
            setting.settings.upload_text = 'Add Image';
            setting.settings.remove_text = 'Remove';
            html += wpAdminTmpls.media_uploader(setting.settings);
            wpAdminInitTmpls[slug] = type;
            wpAdminInitData[slug] = setting.settings;
            break;
        case 'dialog':
            var dialog = {
                css_class           : setting.css_class,
                data_attrs          : '',
                legend_css_class    : (setting.legend_css_class) ? setting.legend_css_class : '',
                title               : (setting.title) ? setting.title : '',
                content             : '',
                buttons             : ''
            };
            if( setting.attrs ){
                _.each( setting.attrs, function( attr ) {
                    dialog.data_attrs += ' ' + attr.prop + '="'+attr.value+'"';
                });
            }
            if( setting.content ){
                if (typeof setting.content === 'string') {
                    dialog.content = setting.content;
                }
                else{
                    var newFormSections = wpatPanelSections(setting.data_name, {
                        settings : setting.content
                    });
                    dialog.content = wpatSectionsContent(newFormSections);
                }
            }
            if( setting.buttons ){
                _.each( setting.buttons, function( button ) {
                    dialog.buttons += wpatSetting(button);
                });
            }
            html += wpAdminTmpls.dialog(dialog);
            wpAdminInitTmpls[slug] = type;
            break;
        default:
            console.log({
                todo : 'add tmpl ' + type
            });
            break;
    }

    //Callback functions
    if( callback ){
        wpAdminInitTmpls[setting.slug] = callback;
    }
    return html;
};

/**
 * Setting Tooltip Title
*/
var wpatTooltipTitle = function (setting){
    var tooltip = (setting.tooltip) ? setting.tooltip : false,
    tooltip_title = (setting.tooltip_title) ? setting.tooltip_title : false;
    return ( tooltip && !tooltip_title ) ? setting.title : tooltip_title;
};

/**
 * Button Action Row
*/
var wpatActionRow = function ( buttons ){
     var buttonHtml = '';
     _.each( buttons, function( button ) {
         if( wpatButtons[button] ){
             buttonHtml +=  wpatSetting( _.clone(wpatButtons[button]) );
         }
     });
     return '<div class="wpat-action-row">'+buttonHtml+'</div>';
};

/**
 * Initialize Functional Settings
*/
var wpatInitTmpls = function ( initTmpls, data, $parent, thisTemplater ){
    _.each( initTmpls, function( tmpl, id ) {
        var $el = $parent.querySelector('#'+id);
        switch (tmpl) {
            case 'multi_select':
            case 'select':
                var dataSlug = $el.getAttribute('data-choices'),
                selectData = ( data.choices[dataSlug] ) ? data.choices[dataSlug] : {};
                wpatInitSelect( $el, { data:selectData }, thisTemplater );
            break;
            case 'editor-html':
            case 'editor-css':
            case 'editor-js':
                wpatInitCodeEditor( $el, tmpl.replace('editor-', '') );
            break;
            case 'editor':
                var editorConfig = data.editor_config;
                if( wpAdminInitData.hasOwnProperty(id) ){
                    // Allow Media Button
                    if( wpAdminInitData[id] === 'media' ){
                        editorConfig.mediaButtons = true;
                    }
                    // Allow full override of settings
                    else {
                        editorConfig = wpAdminInitData[id];
                    }
                }
                wp.editor.initialize( id, editorConfig );
            break;
            case 'media-uploader':
                //todo - dynamic titles and settings
                setTimeout(function(){
                    thisTemplater.renderUploader( $el, wpAdminInitData[id] );
                }, 200);
            break;
            case 'table':
                setTimeout(function(){
                    thisTemplater.renderListTable(wpAdminInitData[id])
                }, 100);
            break;
            case 'add_new_form':
                setTimeout(function(){
                    var data = wpAdminInitData[id],
                    $toggle = $parent.querySelector('#'+data.toggle);
                    data.settings = data.data;
                    thisTemplater.renderAddNewForm( data, $el, $toggle )
                }, 200);
            break;
            case 'dialog':
                console.log('Init dialog');
            break;
            default:
                //init callback function defined by setting
                if (typeof thisTemplater.filters[tmpl] === "function") {
                    thisTemplater.filters[tmpl]($el);
                }
                else{
                    console.log({
                        Error:'Function ' + tmpl + ' does not exist'
                    });
                }
            break;
        }
    });
};

/**
 * Initialize Unlocks
*/
var wpatInitUnlocks = function ( unlocks, $parent ){
    //Unlocks
    _.each( unlocks, function( elements, id ) {
        var $el = $parent.querySelector('#'+id),
        type = ( $el !== null && $el.type ) ? $el.type : false,
        els = {};
        _.each( elements, function( el, i ) {
            if( typeof el === 'string' ){
                els[i] = $parent.querySelector('#'+el);
            }
        });
        if( type ){
            switch (type) {
                case 'checkbox':
                    //Disable / Hide Settings
                    if( !$el.checked ){
                        wpatToggleUnlocks(els, $el);
                    }
                break;
                case 'text':
                    //Disable / Hide Settings
                    if( !$el.value > '' ){
                        wpatToggleUnlocks(els, $el);
                    }
                break;
                default:
                break;
            }
            //Listen for Change Event
            $el.onchange = function(e){
                wpatToggleUnlocks(els, $el);
            }
        }
    });
};

/**
 * Toggle Unlocks
*/
var wpatToggleUnlocks = function ( els, $el ){
    var type = ( $el.type ) ? $el.type : false,
    locked = ($el.checked) ? false : true;
    if(type === 'text'){
        locked = ($el.value > '') ? false : true;
    }
    //Toggle Setting Disabled Attribute
    _.each( els, function( $el ) {
        if( $el ){
            // Label Wrap
            var $wrap = $el.closest('.wpat_setting_label');
            if( ! $wrap ){
                // Check
                $wrap = $el.closest('.wpat_quick_setting')
            }
            if( $wrap ){
                $wrap.setAttribute( 'aria-hidden', locked );
            }
        }
    });
};

/**
 * Initialize Select Woo
*/
var wpatInitSelect = function ( $el, args, thisTemplater ){

    //Destroy Existing
    if ( jQuery($el).data('wpalSelect2')) {
        jQuery($el).wpalSelect2('destroy');
    }

    //Check Data Attrs
    var callback = $el.getAttribute('data-callback'),
    change = $el.getAttribute('data-change'),
    open = $el.getAttribute('data-open'),
    placeholder = $el.getAttribute('data-placeholder'),
    allowClear = $el.getAttribute('data-allow-clear'),
    allowHtml = $el.getAttribute('data-allow-html'),
    disableSearch = $el.getAttribute('data-disable-search'),
    isMultiple = $el.getAttribute('data-multiple'),
    isSortable = (isMultiple) ? $el.getAttribute('data-sortable') : false,
    addEmpty = false;

    //Placeholder
    if( placeholder ){
        args.placeholder = placeholder;
    }

    //Disable clear unless set
    if(allowClear){
        args.allowClear = allowClear;
    }

    //Disable Search
    if( disableSearch ){
        args.minimumResultsForSearch = -1;
    }

    // Allows Icons etc in label
    if( allowHtml ){
        args.escapeMarkup = function(markup) {
            return markup;
        };
        args.templateResult = function(data) {
            return data.html;
        };
        args.templateSelection = function(data) {
            return data.html;
        }
    }

    //init wpalSelect2
    jQuery($el).wpalSelect2(args);
    // Cleanse Selected Values
    var currentValues = jQuery($el).val(),
        deletedSelected = false,
        optionData = args.data;
    if( currentValues > '' && optionData.length ){
        currentValues = currentValues.split(',');
        _.each( currentValues, function( value, index ) {
            if( value > '' && wpatIndexOf( args.data, 'id', value ) < 0 ){
                deletedSelected = true;
                delete currentValues[index];
            }
        });
        if( deletedSelected ){
            currentValues = ( currentValues.length ) ? currentValues.toString() : '';
            jQuery($el).val(currentValues);
        }
    }

    // Render Callback
    if( callback ){
        if (typeof thisTemplater.filters[callback] === "function") {
            thisTemplater.filters[callback]($el, args);
        }
    }

    //Open trigger
    if( open ){
      jQuery($el).on('wpalSelect2:open', function () {
          //todo add delete option https://stackoverflow.com/questions/37386293/how-to-add-icon-in-select2
          window[open]( jQuery($el) );
      });
    }

    //Change trigger
    if( change ){
        if (typeof thisTemplater.filters[change] === "function") {
            jQuery($el).on('change.wpalSelect2', function () {
                thisTemplater.filters[change]($el, args);
            });
        }
    }
    //Disable Search on MultiSelect
    if( isMultiple && disableSearch ){
        jQuery($el).on('wpalSelect2:opening wpalSelect2:closing', function() {
            var $searchfield = jQuery($el).parent().find('.wpalSelect2-search__field');
            $searchfield.prop('disabled', true);
        });
    }
    // Allow Sorting
    if( isMultiple && isSortable ){
        var $parent = jQuery($el).parent(),
            $ul = jQuery("ul.wpalSelect2-selection__rendered", $parent);
        $ul.hover(function(){
            $ul.find('li').removeAttr('title');
        });
        $ul.sortable({
            containment : 'parent',
            tolerance   : 'pointer',
            cancel      : ".wpalSelect2-search--inline",
            create      : function() {
                wpatSelect2SortableSearchField($ul);
            },
            stop : function() {
                var options = [];
                jQuery($ul.find('.wpalSelect2-selection__choice').get()).each(function() {
                    //todo should have a check for select options vs input
                    var id = jQuery(this).data('data').id;
                    options.push(id);
                });
                $el.value = options.toString();
            },
            update : function () {
                wpatSelect2SortableSearchField($ul);
            }
        });
        jQuery($el).on('change.wpalSelect2', function () {
            wpatSelect2SortableSearchField($ul);
        });
    }

};

var wpatSelect2SortableSearchField = function( $ul ){
    var $search = $ul.find('li.wpalSelect2-search--inline');
    if( $search ){
        $search.parent().prepend($search);
    }
}

/**
 * Re-Initialize Select Woo
*/
var wpatReinitSelect2 = function ( $parent, selector, choices, thisTemplater ){
    var select2s = $parent.querySelectorAll( selector );
    _.each( select2s, function( $el ) {
        var dataSlug = $el.getAttribute('data-choices'),
        data = ( choices[dataSlug] ) ? choices[dataSlug] : {};
        wpatInitSelect( $el, {data:data}, thisTemplater );
    });
};

/**
  * Initialize Code Editor
*/
var wpatInitCodeEditor = function ( $el, type ){
    var editorSettings = wp.codeEditor.defaultSettings ? _.clone( wp.codeEditor.defaultSettings ) : {},
    settings = {
      indentUnit  : 2,
      tabSize     : 2,
      autoRefresh : true,
    },
    name = $el.getAttribute("name");
    switch (type) {
      case 'css':
        settings.mode = 'css';
        break;
      case 'js':
        settings.mode = 'javascript';
        break;
      default:
    }
    editorSettings.codemirror = _.extend( {}, editorSettings.codemirror, settings );
    wpAdminCodemirrorEditors[name] = wp.codeEditor.initialize( $el, editorSettings );
};

/**
  * Utility : Generate Form Data
 */
var wpatGenerateFormData = function ( wpatFormData, $form ){
    var error = {},
    data = {};
    _.each( wpatFormData, function( el ) {
        if( el.slug ){
            var $field = $form.querySelector('[name="'+el.slug+'"]');
            if( $field != null ){
                //todo required validation
                var sanitize = ( el.sanitize ) ? el.sanitize : false,
                validate = ( el.validate ) ? el.validate : false,
                required = ( el.required ) ? el.required : false,
                type = el.type,
                value = $field.value,
                name = $field.name;
                switch (type) {
                    case 'switch':
                        $field = $form.querySelector('[type="checkbox"][name="'+el.slug+'"]');
                        data[name] = ( $field.checked ) ? 1 : 0;
                        break;
                    case 'editor':
                        data[name] = wpatGetEditorContent($field);
                        break;
                    case 'multi_select':
                    case 'select':
                        value = [];
                        var selectedData = jQuery($field).wpalSelect2('data');
                        if( selectedData.length ){
                            for (var i = 0; i < selectedData.length; i++) {
                                var selectData = selectedData[i];
                                if( selectData.selected ){
                                    value.push(selectData.id);
                                }
                            }
                        }
                        data[name] = value.length ? value.join() : '';
                        break;
                    case 'datetime':
                    case 'datepicker':
                        var validDate = true,
                            min = $field.getAttribute('min'),
                            max = $field.getAttribute('max'),
                            validMin = true,
                            validMax = true;
                        if( min || max ){
                            validDate = false;
                            var checkDate = new Date(value),
                                fieldWidth = $field.offsetWidth,
                                fieldheight = $field.offsetHeight,
                                isVisible = ( $field.offsetWidth === 0 && $field.offsetHeight === 0 ) ? false : true;
                        }
                        if( min && isVisible ){
                            var minDate = new Date(min);
                            validMin = ( checkDate >= minDate );
                            if(!validMin){
                                error[name] = {
                                    $field  : $field,
                                    error   : 'error-min-date',
                                };
                            }
                        }
                        if( max && isVisible ){
                            var maxDate = new Date(max);
                            validMax = ( checkDate <= maxDate );
                            if(!validMin){
                                error[name] = {
                                    $field  : $field,
                                    error   : 'error-max-date',
                                };
                            }
                        }
                        validDate = ( validMin && validMax );
                        if( validDate ){
                            if(type === 'datetime'){
                                var h = $form.querySelector('[name="'+el.slug+'_hours"]').value,
                                    m = $form.querySelector('[name="'+el.slug+'_minutes"]').value;
                                data[name] =  value + ' ' + h + ":" + m;
                            }
                            else{
                                data[name] = value;
                            }
                        }
                        break;
                    default:
                      data[name] = $field.value;
                      break;
                }
                if( required && ! data[name] > '' ){
                    error[name] = {
                        $field  : $field,
                        error   : 'required'
                    };
                }
                if( validate ){
                    //todo validation callbacks
                }
            }
            else if( el.type && el.type === 'switch_group' ){
                var groupData = [],
                    choices   = wpatChoices[el.choices];
                for( var c in choices ){
                    var choice = choices[c].id;
                    $field = $form.querySelector('[type="checkbox"][name="'+el.slug+'['+choice+']"]');
                    if( $field !== null && $field.checked ){
                        groupData.push(choice);
                    }
                }
                data[el.slug] = groupData.length ? groupData.join() : '';
            }
        }
     });
     return {
         error : ( !Object.keys(error).length ) ? false : error,
         data : data
     };
};

/**
  * Utility : Get Editor Content
 */
var wpatGetEditorContent = function( $editor ){
    var content = '',
        inputID = $editor.id,
        editor = tinyMCE.get(inputID),
        $textArea = jQuery('textarea#' + inputID);
    if ( $textArea.length > 0 && $textArea.is(':visible') ) {
        content = $textArea.val();
    }
    else {
        content = editor.getContent();
    }
    return content;
}

/**
  * Utility : Reset Form
 */
var wpatAddNewReset = function ( $form, formSections ){

    _.each( formSections, function( sections ) {
        var settings = sections.settings;
        _.each( settings, function( el ) {
            if( el.slug ){
                var $field = $form.querySelector('[name="'+el.slug+'"]');
                if( $field != null ){
                    var type = el.type,
                    default_val = ( typeof el.default === 'undefined' ) ? '' : el.default;
                    $field.value = default_val;
                    if( $field.hasAttribute("onchange") ){
                        $field.onchange();
                    }
                    // Clear image
                    if( type === 'media-uploader' ){
                        var $remove = $field.nextElementSibling;
                        if($remove != null){
                            $remove.click()
                        }
                    }
                    // Clear Editor
                    else if( type === 'editor' ){
                        tinyMCE.get($field.id).setContent('');
                    }
                }
            }
        });
    });
};

/**
 * Utility : Priority Sort
*/
var wpatPriority = function ( objects ){
    return _.chain(objects).sortBy(function(object) {
        return object.priority;
    }).value();
};

/**
 * Nested Search
*/
var wpatNestedFilter = function ( data, filters ){
    if( !Array.isArray(data) ){
        data = wpatObjectToArray(data);
    }
    var filterKeys = Object.keys(filters);
    return data.filter(function (eachObj) {
        return filterKeys.every(function (eachKey) {
            if (!filters[eachKey].length) {
                return true;
            }
            return filters[eachKey].includes(eachObj[eachKey]);
        });
    });
};

/**
 * Utility : Has Class
*/
var wpatAdminHasClass = function ( $el, css_class ){
    return (' ' + $el.className + ' ').indexOf(' ' + css_class + ' ') > -1;
};

/**
 * Utility : Toggle Aria Attr
*/
var wpatToggleAria = function ($el, attr){

    var attrName = 'aria-'+attr,
    currentValue = ( $el.hasAttribute(attrName) ) ? $el.getAttribute(attrName) : 'false',
    attrValue = ( currentValue == 'true' ) ? 'false' : 'true';
    $el.setAttribute(attrName, attrValue);
    return attrValue;
};

/**
 * Utility : Object to Array
*/
var wpatObjectToArray = function (obj){
    return Object.keys(obj).map(function (key) {
        return obj[key];
    });
};

/**
 * Utility : WP AJAX Requests
*/
var wpatRequest = function (method, data, callback){
    //Prepare Data
    if (typeof data === 'string' || data instanceof String){
        var action = data;
        data = { action : action };
    }
    var postData = Object.keys(data).map(function(key) {
        return key + '=' + encodeURIComponent(data[key])
    }).join('&');
    var request = new XMLHttpRequest();
    request.open(method, wpAdminAjaxUrl, true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
    request.onload = function () {
        // Process the response
        if (request.status >= 200 && request.status < 300) {
            var response = JSON.parse(request.responseText);
            callback(response);
        }
        else{
            console.log({
                func: 'wpatRequest',
                status: request.status,
                statusText: request.statusText
            });
        }
    }
    request.send(postData);
};

/**
 * Utility : Return Index of object by key value
*/
var wpatIndexOf = function (obj, key, value){
    var index = -1;
    _.each( obj, function( properties, i ) {
        if( properties[key] == value ){
            index = i;
        }
    });
    return index;
};

/**
 * Name Like Search
 * TODO - array of property names to search
*/
var wpatNameLike = function (data, name){
    var likeRows = [];
    _.each( data, function( row, id ) {
        var needle = name.toLowerCase(),
        haystack = row.name.toLowerCase();
        if( haystack.indexOf(needle) >= 0 ){
            likeRows.push(row);
        }
    });
    return likeRows;
};

/**
 * Utility : Push Attr to Array
*/
var wpatAttr = function ( setting, prop, value ){
    setting.settings.inputAttr.push({
        prop    : prop,
        value   : value
    });
    return setting;
};

/**
 * Utility : Test if input type date is supported
 */
var wpatDateSupported = function () {
	var input = document.createElement('input');
	input.setAttribute('type', 'date');
	input.setAttribute('value', 'x');
	return (input.value !== 'x');
};

/**
 * Utility : Date Picker Pattern
 */
var wpatDatePattern = function (){
    var pattern = '(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])';
    pattern += '-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])';
    pattern += '-(?:30))|(?:(?:0[13578]|1[02])-31))';
    return pattern;
};

/**
 * Utility : sprintf type function
 */
var wpatSprintF = function (format, args){
    var i = 0;
    return format.replace(/%s/g, function() {
        return args[i++];
    });
};

/**
 * Utility : Return Timestamp as array
 */
var wpatTimestampArray = function (timestamp){

    var data = {},
        date = new Date(timestamp*1000);
    data.year = date.getFullYear();
    data.month = date.getMonth() + 1;
    data.month = ( data.month < 10 ) ? "0" + data.month : data.month;
    data.day = date.getDate();
    data.day = ( data.day < 10 ) ? "0" + data.day : data.day;
    data.hours = date.getHours();
    data.minutes = "0" + date.getMinutes();
    data.minutes = data.minutes.substr(-2);
    data.seconds = "0" + date.getSeconds();
    data.seconds = data.seconds.substr(-2);
    return data;
};

/**
 * Utility : Vanilla closest() Polyfill
 */
if (window.Element && !Element.prototype.closest) {
    Element.prototype.closest =
    function(s) {
        var matches = (this.document || this.ownerDocument).querySelectorAll(s),
            i,
            el = this;
        do {
            i = matches.length;
            while (--i >= 0 && matches.item(i) !== el) {};
        } while ((i < 0) && (el = el.parentElement));
        return el;
    };
};