window.m4acGroupAccountsData = window.m4acGroupAccountsData || {};
document.addEventListener('DOMContentLoaded', function(){
    'use strict';
    if( m4acGroupAccountsData.hasOwnProperty('groupAccountsListChildren') ){
        m4acGroupAccountsListChildren.init(m4acGroupAccountsData.groupAccountsListChildren);
    }
}, false);

/**
 * Manage Group Accounts Child Lists
 *
 * @namespace m4acGroupAccountsListChildren
 *
 * @since 1.190
 *
 * @type {Object}
 *
*/
window.m4acGroupAccountsListChildren = {
    I18N     : {},
    data     : {},
    els      : {},
    state    : {},
    init     : function ( data ){

        var t  = this;
        t.I18N = data.I18N;
        t.data = data.data;
        for( var id in t.data ){
            t.els[id] = {
                $wrapper : document.querySelector('[data-memb_list_children_number="'+id+'"]'),
                $tbody   : null,
                $nav     : null,
                $message : null,
            };
            t.state[id] = {
                loading : false,
                search  : false,
                reload  : false
            };
            if( t.els[id].$wrapper !== null ){
                t.els[id].$tbody   = t.els[id].$wrapper.querySelector('table tbody');
                t.els[id].$nav     = t.els[id].$wrapper.querySelector('.memb_list_children-nav');
                t.els[id].$message = t.els[id].$wrapper.querySelector('.memb_list_children-results-message');
                t.addEventListeners(id, t);
                m4acGroupAccountsDispatchEvent( 'm4acGroupAccounts/ListChildren/ready', {
                    id  : id,
                    app : t
                } );
            }
        }

    },
    addEventListeners : function(id, t){
        // Generic Click
        t.els[id].$wrapper.addEventListener('click', function (e) {
            var $el = e.target,
                action;
            if ($el.matches('[data-memb_list_children-action]')) {
                e.preventDefault();
                if( ! t.state[id].loading ){
                    action = $el.getAttribute('data-memb_list_children-action');
                    if( action === 'search' ){
                        t.searchList(id, t);
                    }
                    else if( action === 'disconnect' ){
                        t.disconnectChild($el, id, t);
                    }
                    else if( parseInt(action) > 0 ){
                        t.loadPage(parseInt(action), id, t);
                    }
                }
            }
        });

    },
    searchList : function( id, t ){
        var $search  = t.els[id].$wrapper.querySelector('[type="search"]'),
            s        = $search !== null ? $search.value : '';
        // Empty Search
        if( ! s > '' ){
            // Clearing Search Results Reload first page
            if( t.state[id].search ){
                t.state[id].reload = true;
                t.state[id].search = false;
                t.loadPage( 1, id, t );
            }
            // Empty Search Notice
            else{
                alert(t.I18N.empty_search);
            }
        }
        else{
            t.state[id].reload = true;
            t.state[id].search = s;
            var postData = t.defaultData( 'shortcode_update_list', t.data[id].page, id, t );
            t.toggleLoading( true, id, t );
            m4acGroupAccountsPostData( postData, function( response ){
                t.updateListEls( response, id, t );
            });
        }
    },
    disconnectChild : function( $el, id, t ){
        if( window.confirm(t.I18N.confirm_disconect) ){
            t.toggleLoading( true, id, t );
            var postData = t.defaultData( 'disconnect_child', t.data[id].page, id, t );
            postData.child_uid = $el.value;
            m4acGroupAccountsPostData( postData, function( response ){
                if( response.data && response.data.message ){
                    alert(response.data.message);
                }
                if( response.success ){
                    $el.closest('tr').remove();
                }
                t.toggleLoading( false, id, t );
                m4acGroupAccountsDispatchEvent( 'm4acGroupAccounts/ListChildren/disconnectChild', {
                    id  : id,
                    app : t,
                } );
            });
        }
    },
    loadPage : function( page, id, t ){
        t.toggleLoading( true, id, t );
        var postData = t.defaultData( 'shortcode_update_list', page, id, t );
        m4acGroupAccountsPostData( postData, function( response ){
            t.updateListEls( response, id, t );
        });
    },
    defaultData : function( operation, page, id, t ){
        var postData       = JSON.parse(JSON.stringify(t.data[id]));
        postData.action    = 'm4ac_groupcontacts_ajax_handler';
        postData.operation = operation;
        postData.page      = parseInt(page);
        // Check if Search
        if( t.state[id].search ){
            postData.s = t.state[id].search;
        }
        // Trigger Full count Reload
        if( t.state[id].reload ){
            postData.reload    = true;
            t.state[id].reload = false;
        }
        return postData;
    },
    toggleLoading : function( loading, id, t ){
        t.state[id].loading = loading;
        if( loading ){
            t.els[id].$wrapper.classList.add('memb_list_children-loading');
        }
        else{
            setTimeout(function(){
                t.els[id].$wrapper.classList.remove('memb_list_children-loading');
            }, 100 );
        }
    },
    updateListEls : function( response, id, t ){
        var data    = response.data ? response.data : {},
            list    = data.list ? data.list : false,
            nav     = data.nav ? data.nav : false,
            page    = data.page ? parseInt(data.page) : 1,
            message = data.message ? data.message : false;
        if( list > ''&& null !== t.els[id].$tbody ){
            t.els[id].$tbody.innerHTML = list;
        }
        if( nav > '' && null !== t.els[id].$nav ){
            t.els[id].$nav.innerHTML = nav;
        }
        t.updateMessage( message, id, t );
        if( response.success ){
            t.data[id].page = page;
        }
        t.toggleLoading( false, id, t );
        m4acGroupAccountsDispatchEvent( 'm4acGroupAccounts/ListChildren/updated', {
            id  : id,
            app : t
        } );
    },
    updateMessage : function( message, id, t ){
        if( null !== t.els[id].$message ){
            t.els[id].$message.innerHTML = "";
            if( message && message > '' ){
                t.els[id].$message.innerHTML = "<p>"+message+"</p>";
            }
        }
    }
};

/**
 * Utility : Make POST Request
 *
 * @namespace m4acGroupAccountsPostData
 *
 * @since 1.190
 *
 * @type {Function}
 *
*/
window.m4acGroupAccountsPostData = function( data, callback ){
    var postData = Object.keys(data).map(function(key) {
        return key + '=' + encodeURIComponent(data[key])
    }).join('&');
    var r = new XMLHttpRequest();
    r.open('POST', m4acGroupAccountsData.ajaxUrl, false);
    r.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
    r.onload = function () {
        // Process the response
        if (r.status >= 200 && r.status < 300) {
            var response = JSON.parse(r.responseText);
            callback(response);
        }
        else{
            alert( 'There has been an error with your request.' );
            console.error({
                func       : 'm4acGroupAccountsPostData',
                status     : r.status,
                statusText : r.statusText
            });
        }
    }
    r.send(postData);
};

// Utility : Dispatch Event
var m4acGroupAccountsDispatchEvent = function( eventName, args ){
    document.dispatchEvent(new CustomEvent(eventName, { detail : args }));
};