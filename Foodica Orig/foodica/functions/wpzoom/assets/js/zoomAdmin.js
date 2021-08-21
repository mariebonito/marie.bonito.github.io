/*
 *  jQuery selectBox (version 1.0.7)
 *
 *  Copyright 2011 Cory LaViska for A Beautiful Site, LLC.
 *
 *  http://abeautifulsite.net/blog/2011/01/jquery-selectbox-plugin/
 *
 */
jQuery&&function(e){e.extend(e.fn,{selectBox:function(t,s){var o,a="",l=function(t,s){var o;switch(s){case"inline":return o=e('<ul class="selectBox-options" />'),t.find("OPTGROUP").length?t.find("OPTGROUP").each(function(){var t=e('<li class="selectBox-optgroup" />');t.text(e(this).attr("label")),o.append(t),e(this).find("OPTION").each(function(){var t=e("<li />"),s=e("<a />");t.addClass(e(this).attr("class")),s.attr("rel",e(this).val()).text(e(this).text()),t.append(s),e(this).attr("disabled")&&t.addClass("selectBox-disabled"),e(this).attr("selected")&&t.addClass("selectBox-selected"),o.append(t)})}):t.find("OPTION").each(function(){var t=e("<li />"),s=e("<a />");t.addClass(e(this).attr("class")),s.attr("rel",e(this).val()).text(e(this).text()),t.append(s),e(this).attr("disabled")&&t.addClass("selectBox-disabled"),e(this).attr("selected")&&t.addClass("selectBox-selected"),o.append(t)}),o.find("A").on("mouseover.selectBox",function(s){d(t,e(this).parent())}).on("mouseout.selectBox",function(s){r(t,e(this).parent())}).on("mousedown.selectBox",function(e){e.preventDefault(),t.selectBox("control").hasClass("selectBox-active")||t.selectBox("control").focus()}).on("mouseup.selectBox",function(s){c(),i(t,e(this).parent(),s)}),p(o),o;case"dropdown":return o=e('<ul class="selectBox-dropdown-menu selectBox-options" />'),t.find("OPTGROUP").length?t.find("OPTGROUP").each(function(){var t=e('<li class="selectBox-optgroup" />');t.text(e(this).attr("label")),o.append(t),e(this).find("OPTION").each(function(){var t=e("<li />"),s=e("<a />");t.addClass(e(this).attr("class")),s.attr("rel",e(this).val()).text(e(this).text()),t.append(s),e(this).attr("disabled")&&t.addClass("selectBox-disabled"),e(this).attr("selected")&&t.addClass("selectBox-selected"),o.append(t)})}):t.find("OPTION").length>0?t.find("OPTION").each(function(){var t=e("<li />"),s=e("<a />");t.addClass(e(this).attr("class")),s.attr("rel",e(this).val()).text(e(this).text()),t.append(s),e(this).attr("disabled")&&t.addClass("selectBox-disabled"),e(this).attr("selected")&&t.addClass("selectBox-selected"),o.append(t)}):o.append("<li> </li>"),o.data("selectBox-select",t).css("display","none").appendTo("BODY").find("A").on("mousedown.selectBox",function(e){e.preventDefault(),e.screenX===o.data("selectBox-down-at-x")&&e.screenY===o.data("selectBox-down-at-y")&&(o.removeData("selectBox-down-at-x").removeData("selectBox-down-at-y"),c())}).on("mouseup.selectBox",function(s){s.screenX===o.data("selectBox-down-at-x")&&s.screenY===o.data("selectBox-down-at-y")||(o.removeData("selectBox-down-at-x").removeData("selectBox-down-at-y"),i(t,e(this).parent()),c())}).on("mouseover.selectBox",function(s){d(t,e(this).parent())}).on("mouseout.selectBox",function(s){r(t,e(this).parent())}),p(o),o}},n=function(t){var s=(t=e(t)).data("selectBox-control"),o=t.data("selectBox-settings"),a=s.data("selectBox-options");if(s.hasClass("selectBox-disabled"))return!1;switch(c(),o.autoWidth&&a.css("width",s.outerWidth()-(parseInt(s.css("borderLeftWidth"))+parseInt(s.css("borderLeftWidth")))),a.css({top:s.offset().top+s.outerHeight()-parseInt(s.css("borderBottomWidth")),left:s.offset().left}),o.menuTransition){case"fade":a.fadeIn(o.menuSpeed);break;case"slide":a.slideDown(o.menuSpeed);break;default:a.show(o.menuSpeed)}var l=a.find(".selectBox-selected:first");x(t,l,!0),d(t,l),s.addClass("selectBox-menuShowing"),e(document).on("mousedown.selectBox",function(t){e(t.target).parents().addBack().hasClass("selectBox-options")||c()})},c=function(){0!==e(".selectBox-dropdown-menu").length&&(e(document).off("mousedown.selectBox"),e(".selectBox-dropdown-menu").each(function(){var t=e(this),s=t.data("selectBox-select"),o=s.data("selectBox-control"),a=s.data("selectBox-settings");switch(a.menuTransition){case"fade":t.fadeOut(a.menuSpeed);break;case"slide":t.slideUp(a.menuSpeed);break;default:t.hide(a.menuSpeed)}o.removeClass("selectBox-menuShowing")}))},i=function(t,s,o){t=e(t),s=e(s);var a,l=t.data("selectBox-control");t.data("selectBox-settings");if(l.hasClass("selectBox-disabled"))return!1;if(0===s.length||s.hasClass("selectBox-disabled"))return!1;t.attr("multiple")?o.shiftKey&&l.data("selectBox-last-selected")?(s.toggleClass("selectBox-selected"),a=(a=s.index()>l.data("selectBox-last-selected").index()?s.siblings().slice(l.data("selectBox-last-selected").index(),s.index()):s.siblings().slice(s.index(),l.data("selectBox-last-selected").index())).not(".selectBox-optgroup, .selectBox-disabled"),s.hasClass("selectBox-selected")?a.addClass("selectBox-selected"):a.removeClass("selectBox-selected")):o.metaKey?s.toggleClass("selectBox-selected"):(s.siblings().removeClass("selectBox-selected"),s.addClass("selectBox-selected")):(s.siblings().removeClass("selectBox-selected"),s.addClass("selectBox-selected"));l.hasClass("selectBox-dropdown")&&l.find(".selectBox-label").text(s.text());var n=0,c=[];return t.attr("multiple")?l.find(".selectBox-selected A").each(function(){c[n++]=e(this).attr("rel")}):c=s.find("A").attr("rel"),l.data("selectBox-last-selected",s),t.val()!==c&&(t.val(c),t.trigger("change")),!0},d=function(t,s){t=e(t),s=e(s),t.data("selectBox-control").data("selectBox-options").find(".selectBox-hover").removeClass("selectBox-hover"),s.addClass("selectBox-hover")},r=function(t,s){t=e(t),s=e(s),t.data("selectBox-control").data("selectBox-options").find(".selectBox-hover").removeClass("selectBox-hover")},x=function(t,s,o){if(s&&0!==s.length){var a=(t=e(t)).data("selectBox-control"),l=a.data("selectBox-options"),n=a.hasClass("selectBox-dropdown")?l:l.parent(),c=parseInt(s.offset().top-n.position().top),i=parseInt(c+s.outerHeight());o?n.scrollTop(s.offset().top-n.offset().top+n.scrollTop()-n.height()/2):(c<0&&n.scrollTop(s.offset().top-n.offset().top+n.scrollTop()),i>n.height()&&n.scrollTop(s.offset().top+s.outerHeight()-n.offset().top+n.scrollTop()-n.height()))}},h=function(t,s){var o=(t=e(t)).data("selectBox-control"),l=o.data("selectBox-options"),h=0,f=0;if(!o.hasClass("selectBox-disabled"))switch(s.keyCode){case 8:s.preventDefault(),a="";break;case 9:case 27:c(),r(t);break;case 13:o.hasClass("selectBox-menuShowing")?(i(t,l.find("LI.selectBox-hover:first"),s),o.hasClass("selectBox-dropdown")&&c()):n(t);break;case 38:case 37:if(s.preventDefault(),o.hasClass("selectBox-menuShowing")){var p=l.find(".selectBox-hover").prev("LI");for(h=l.find("LI:not(.selectBox-optgroup)").length,f=0;(0===p.length||p.hasClass("selectBox-disabled")||p.hasClass("selectBox-optgroup"))&&(0===(p=p.prev("LI")).length&&(p=l.find("LI:last")),!(++f>=h)););d(t,p),x(t,p)}else n(t);break;case 40:case 39:if(s.preventDefault(),o.hasClass("selectBox-menuShowing")){var B=l.find(".selectBox-hover").next("LI");for(h=l.find("LI:not(.selectBox-optgroup)").length,f=0;(0===B.length||B.hasClass("selectBox-disabled")||B.hasClass("selectBox-optgroup"))&&(0===(B=B.next("LI")).length&&(B=l.find("LI:first")),!(++f>=h)););d(t,B),x(t,B)}else n(t)}},f=function(t,s){var l=(t=e(t)).data("selectBox-control"),c=l.data("selectBox-options");if(!l.hasClass("selectBox-disabled"))switch(s.keyCode){case 9:case 27:case 13:case 38:case 37:case 40:case 39:break;default:l.hasClass("selectBox-menuShowing")||n(t),s.preventDefault(),clearTimeout(o),a+=String.fromCharCode(s.charCode||s.keyCode),c.find("A").each(function(){if(e(this).text().substr(0,a.length).toLowerCase()===a.toLowerCase())return d(t,e(this).parent()),x(t,e(this).parent()),!1}),o=setTimeout(function(){a=""},1e3)}},p=function(t){e(t).css("MozUserSelect","none").on("selectstart",function(e){e.preventDefault()})};switch(t){case"control":return e(this).data("selectBox-control");case"settings":if(!s)return e(this).data("selectBox-settings");e(this).each(function(){e(this).data("selectBox-settings",e.extend(!0,e(this).data("selectBox-settings"),s))});break;case"options":e(this).each(function(){!function(t,o){var a=(t=e(t)).data("selectBox-control");t.data("selectBox-settings");switch(typeof s){case"string":t.html(s);break;case"object":for(var n in t.html(""),s)if(null!==s[n])if("object"==typeof s[n]){var c=e('<optgroup label="'+n+'" />');for(var i in s[n])c.append('<option value="'+i+'">'+s[n][i]+"</option>");t.append(c)}else{var d=e('<option value="'+n+'">'+s[n]+"</option>");t.append(d)}}if(a){a.data("selectBox-options").remove();var r=a.hasClass("selectBox-dropdown")?"dropdown":"inline";switch(o=l(t,r),a.data("selectBox-options",o),r){case"inline":a.append(o);break;case"dropdown":a.find(".selectBox-label").text(e(t).find("OPTION:selected").text()||" "),e("BODY").append(o)}}}(this,s)});break;case"value":if(!s)return e(this).val();e(this).each(function(){!function(t,s){(t=e(t)).val(s),s=t.val();var o=t.data("selectBox-control");if(o){var a=t.data("selectBox-settings"),l=o.data("selectBox-options");o.find(".selectBox-label").text(e(t).find("OPTION:selected").text()||" "),l.find(".selectBox-selected").removeClass("selectBox-selected"),l.find("A").each(function(){if("object"==typeof s)for(var t=0;t<s.length;t++)e(this).attr("rel")==s[t]&&e(this).parent().addClass("selectBox-selected");else e(this).attr("rel")==s&&e(this).parent().addClass("selectBox-selected")}),a.change&&a.change.call(t)}}(this,s)});break;case"enable":e(this).each(function(){!function(t){(t=e(t)).attr("disabled",!1);var s=t.data("selectBox-control");s&&s.removeClass("selectBox-disabled")}(this)});break;case"disable":e(this).each(function(){!function(t){(t=e(t)).attr("disabled",!0);var s=t.data("selectBox-control");s&&s.addClass("selectBox-disabled")}(this)});break;case"destroy":e(this).each(function(){var t,s;(s=(t=e(t=this)).data("selectBox-control"))&&(s.data("selectBox-options").remove(),s.remove(),t.removeClass("selectBox").removeData("selectBox-control").removeData("selectBox-settings").show())});break;default:e(this).each(function(){!function(t,s){if(navigator.userAgent.match(/iPad|iPhone|Android/i))return!1;if("select"!==t.tagName.toLowerCase())return!1;if((t=e(t)).data("selectBox-control"))return!1;var o=e('<a class="selectBox" />'),a=t.attr("multiple")||parseInt(t.attr("size"))>1,i=s||{};if(void 0===i.autoWidth&&(i.autoWidth=!0),o.addClass(t.attr("class")).attr("style",t.attr("style")||"").attr("title",t.attr("title")||"").attr("tabindex",parseInt(t.attr("tabindex"))).css("display","inline-block").on("focus.selectBox",function(){this!==document.activeElement&&e(document.activeElement).blur(),o.hasClass("selectBox-active")||(o.addClass("selectBox-active"),t.trigger("focus"))}).on("blur.selectBox",function(){o.hasClass("selectBox-active")&&(o.removeClass("selectBox-active"),t.trigger("blur"))}),t.attr("disabled")&&o.addClass("selectBox-disabled"),a){var d=l(t,"inline");if(o.append(d).data("selectBox-options",d).addClass("selectBox-inline").addClass("selectBox-menuShowing").on("keydown.selectBox",function(e){h(t,e)}).on("keypress.selectBox",function(e){f(t,e)}).on("mousedown.selectBox",function(t){e(t.target).is("A.selectBox-inline")&&t.preventDefault(),o.hasClass("selectBox-focus")||o.focus()}).insertAfter(t),!t[0].style.height){var r=t.attr("size")?parseInt(t.attr("size")):5,x=o.clone().removeAttr("id").css({position:"absolute",top:"-9999em"}).show().appendTo("body");x.find(".selectBox-options").html("<li><a> </a></li>"),optionHeight=parseInt(x.find(".selectBox-options A:first").html("&nbsp;").outerHeight()),x.remove(),o.height(optionHeight*r)}p(o)}else{var B=e('<span class="selectBox-label" />'),u=e('<span class="selectBox-arrow" />');B.text(e(t).find("OPTION:selected").text()||" "),(d=l(t,"dropdown")).appendTo("BODY"),o.data("selectBox-options",d).addClass("selectBox-dropdown").append(B).append(u).on("mousedown.selectBox",function(e){o.hasClass("selectBox-menuShowing")?c():(e.stopPropagation(),d.data("selectBox-down-at-x",e.screenX).data("selectBox-down-at-y",e.screenY),n(t))}).on("keydown.selectBox",function(e){h(t,e)}).on("keypress.selectBox",function(e){f(t,e)}).insertAfter(t),p(o)}t.addClass("selectBox").data("selectBox-control",o).data("selectBox-settings",i).hide()}(this,t)})}return e(this)}})}(jQuery);

window.Mousetrap=function(){function m(a,e,b){if(a.addEventListener)return a.addEventListener(e,b,!1);a.attachEvent("on"+e,b)}function n(a){var a=a||{},e=!1,b;for(b in h)a[b]?e=!0:h[b]=0;e||(k=!1)}function q(a,e,b,c){var f,g,d=[];if(!i[a])return[];if("keyup"==b&&(15<a&&19>a||91==a))e=[a];for(f=0;f<i[a].length;++f)g=i[a][f],!(g.seq&&h[g.seq]!=g.level)&&(b==g.action&&e.sort().join(",")===g.modifiers.sort().join(","))&&(c&&i[a].splice(f,1),d.push(g));return d}function r(a,e,b){var c;c=b.target||b.srcElement;
var f=c.tagName;c=-1<(" "+c.className+" ").indexOf(" mousetrap ")?!1:"INPUT"==f||"SELECT"==f||"TEXTAREA"==f;if(!c){c=[];b.shiftKey&&c.push(j.shift);b.altKey&&c.push(j.alt);b.ctrlKey&&c.push(j.ctrl);b.metaKey&&c.push(j.command);c=q(a,c,e);for(var g={},d=!1,f=0;f<c.length;++f)if(c[f].seq)d=!0,g[c[f].seq]=1,c[f].callback(b);else if(!d&&!k){c[f].callback(b);break}e==k&&!(15<a&&19>a||91==a)&&n(g)}}function v(a){r(93==a.keyCode||224==a.keyCode?91:a.keyCode,"keydown",a)}function w(a){o===a.keyCode?o=!1:
r(93==a.keyCode||224==a.keyCode?91:a.keyCode,"keyup",a)}function x(a,e,b,c){h[a]=0;var f=function(){k=c;++h[a];clearTimeout(s);s=setTimeout(n,1E3)},g=function(a){b(a);"keydown"===c&&(o=a.keyCode);setTimeout(n,10)},d;for(d=0;d<e.length;++d)t(e[d],d<e.length-1?f:g,c,a,d)}function t(a,e,b,c,f){var a=a.replace(/\s+/g," "),g=a.split(" "),d,h=[];if(1<g.length)return x(a,g,e,b);g="+"===a?["+"]:a.split("+");for(a=0;a<g.length;++a)d=g[a],u[d]&&(h.push(j.shift),d=u[d]),d=j[d]||d.toUpperCase().charCodeAt(0),
(15<d&&19>d||91==d)&&h.push(d);i[d]||(i[d]=[]);q(d,h,b,!c);i[d][c?"unshift":"push"]({callback:e,modifiers:h,action:b,seq:c,level:f})}for(var j={backspace:8,tab:9,enter:13,"return":13,shift:16,ctrl:17,alt:18,option:18,capslock:20,esc:27,escape:27,space:32,pageup:33,pagedown:34,end:35,home:36,left:37,up:38,right:39,down:40,del:46,meta:91,command:91,";":186,"=":187,",":188,"-":189,".":190,"/":191,"`":192,"[":219,"\\":220,"]":221,"'":222},u={"~":"`","!":"1","@":"2","#":"3",$:"4","%":"5","^":"6","&":"7",
"*":"8","(":"9",")":"0",_:"-","+":"=",":":";",'"':"'","<":",",">":".","?":"/","|":"\\"},i={},p={},h={},s,o=!1,k=!1,l=1;20>l;++l)j["f"+l]=111+l;return{bind:function(a,e,b){for(var b=b||"keydown",c=a instanceof Array?a:a.split(","),f=b,g=0;g<c.length;++g)t(c[g],e,f);p[a+":"+b]=e},trigger:function(a,e){p[a+":"+(e||"keydown")]()},addEvent:function(a,e,b){m(a,e,b)},reset:function(){i={};p={}},init:function(){m(document,"keydown",v);m(document,"keyup",w)}}}();Mousetrap.addEvent(window,"load",Mousetrap.init);

/**
 * Bind mousetrap hotkeys
 */
jQuery(document).ready(function($) {
    Mousetrap.bind(['ctrl+s', 'command+s'], function(e) {
        $("#zoomForm").trigger('submit');

        e.preventDefault();
    });
})

/**
 * Tabs functionality
 */
jQuery(document).ready(function($) {
    $("SELECT").selectBox();

    //When page loads...
    $(".tab_content").hide();
    $(".tab_content .sub").hide(); // Hide all subtabs

    var section = Cookies.get('active_section');
    var tab = Cookies.get('active_tab');

    // Replace all double quotes from cookies string
    if ( typeof section != 'undefined' && section.indexOf('"') >= 0 ) {
        section = section.replace(/['"]+/g, '');
    }
    if ( typeof tab != 'undefined' && tab.indexOf('"') >= 0 ) {
        tab = tab.replace(/['"]+/g, '');
    }

    // 1. Check if Theme Options has `active_section` and `active_tab` cookies value in DOM elements
    // 2. Set values to new cookies renamed with themName prefix (e.g. ${themName}_active_section, ${themeName}_active_tab)
    // 3. Remove cookies `active_section` and `active_tab` only if they were found in DOM elements
    if ( $("#zoomWrap").find( section ).length ) {
        Cookies.set( `${ WPZOOM_Theme_Options.themeName }_active_section`, section );
        Cookies.remove( 'active_section' );
    }

    if ( $("#zoomWrap").find( tab ).length ) {
        Cookies.set( `${ WPZOOM_Theme_Options.themeName }_active_tab`, tab );
        Cookies.remove( 'active_tab' );
    }

    section = Cookies.get( `${ WPZOOM_Theme_Options.themeName }_active_section` );
    tab = Cookies.get( `${ WPZOOM_Theme_Options.themeName }_active_tab` );

    // Trigger General tab if section and tab were not found in the DOM elements
    if ( ! $("#zoomWrap").find( section ).length || ! $("#zoomWrap").find( tab ).length ) {
        var generalTabSectionId = $('#zoomWrap').find('.tabs > .general a').attr('href');
        var generalTabId = $('#zoomWrap').find(`${ generalTabSectionId } .zoomForms > div:first-child`).attr('id');

        section = generalTabSectionId;
        tab = `#${ generalTabId }`;

        Cookies.set( `${ WPZOOM_Theme_Options.themeName }_active_section`, section );
        Cookies.set( `${ WPZOOM_Theme_Options.themeName }_active_tab`, tab );
    }

    // Replace all double quotes from new generated cookies string
    if ( typeof section != 'undefined' && section.indexOf('"') >= 0 ) {
        section = section.replace(/['"]+/g, '');
    }
    if ( typeof tab != 'undefined' && tab.indexOf('"') >= 0 ) {
        tab = tab.replace(/['"]+/g, '');
    }

    if (!section || !tab) {
        $("ul.tabs li:first").addClass("active").show(); //Activate first tab
        $("ul.tabs li:first li:first").addClass("active").show(); //Activate first subtab
        $(".tab_content:first").show(); //Show first tab content
        $(".tab_content:first .sub:first").show(); // Show first subtab content
    } else {
        $('a[href="' + section +'"]').parent().addClass('active').show();
        $('a[href="' + tab + '"]').parent().addClass('active');
        $(section).show();
        $(tab).show();
    }

    $(".tab_container").fadeIn();

    /* Handle clicks for arrow icon */
    $("ul.tabs em").on('click', function() {
        var id = $(this).parent().attr("id");

        // open clicked panel
        $(this).parent().find('ul').slideToggle('fast', function(){
            $(this).parent().toggleClass("a-open");
        });

        /* trigger custom event zoom:nav:changed  */
        $('#zoomWrap').trigger('zoom:nav:changed');

    });

    /* Handle clicks for accordeons */
    $(".wz-parent > a").on('click', function() {
        // prevent flickering
        if ($(this).parent().hasClass('active')) {
            return false;
        }
        var id = $(this).parent().attr("id");
        var activeTab = $(this).attr('href');

        $(".wz-parent").removeClass('active');

        // close all other tabs
        $("#zoomWrap .tabs .sub").removeClass('active');
        $("#zoomWrap .tabs ul").slideUp('fast');


        $(this).parent().find('ul').slideDown('fast');
        $(this).parent().addClass('active');

        if ($(this).parent().hasClass('active')) {
            $(".sub").removeClass('active');

            $(this).parent().find('li:first').addClass('active');

            $(".zoomForms .sub").hide();
            $(".tab_content").hide();

            $(activeTab).show();
            $(activeTab + ' .sub').first().slideDown();

            Cookies.set( `${ WPZOOM_Theme_Options.themeName }_active_section`, activeTab );
            Cookies.set( `${ WPZOOM_Theme_Options.themeName }_active_tab`, '#' + $(activeTab + ' .sub').first().attr('id') );
        }

        $(this).parent().find('li:first').addClass('active');

        /* trigger custom event zoom:nav:changed  */
        $('#zoomWrap').trigger('zoom:nav:changed');

        return false;

    });

    /* Handle clicks for tabs */
    $(".sub > a").on('click', function() {
        // prevent flickering
        if ($(this).parent().hasClass('active')) {
            return false;
        }
        $(".sub").removeClass('active');
        $(this).parent().addClass('active');
        var p = $(this).parent().parent().parent().find('a').first().attr('href');

        $(".wz-parent").removeClass('active');
        $(this).parent().parent().parent().addClass('active');

        $(".zoomForms .sub").hide();
        $(".tab_content").hide();


        var activeTab = $(this).attr('href');
        $(p).show();
        $(activeTab).show();

        Cookies.set( `${ WPZOOM_Theme_Options.themeName }_active_section`, p );
        Cookies.set( `${ WPZOOM_Theme_Options.themeName }_active_tab`, activeTab );

        /* trigger custom event zoom:nav:changed  */
        $('#zoomWrap').trigger('zoom:nav:changed');

        return false;
    });

    Mousetrap.bind(['j'], function(e) {
        var active_tab = $('.sub.active'),
            active_section = $('.wz-parent.active'),
            tab_id = active_tab.find('a').attr('href'),
            next_tab,
            next_section;

        // find next one
        next_tab = active_tab.next();

        if (!next_tab.length) {
            next_section = active_section.next();
            if (!next_section.length) return;

            next_tab = next_section.find('.sub').first();

            // change sections
            $('.wz-parent').removeClass('active');
            // close all other tabs
            $("#zoomWrap .tabs .sub").removeClass('active');
            $("#zoomWrap .tabs ul").slideUp('fast');

            next_section.find('ul').slideDown('fast');
            next_section.addClass('active');
        }

        $('.sub').removeClass('active');
        next_tab.addClass('active');

        $(".zoomForms .sub").hide();

        if (next_section && next_section.length) {
            $(".tab_content").hide();
            $(next_section.find('a').first().attr('href')).show();
        }

        $(next_tab.find('a').attr('href')).show();

        e.preventDefault();
    });

    Mousetrap.bind(['k'], function(e) {
        var active_tab = $('.sub.active'),
        active_section = $('.wz-parent.active'),
        tab_id = active_tab.find('a').attr('href'),
        next_tab,
        next_section;

        // find next one
        next_tab = active_tab.prev();

        if (!next_tab.length) {
            next_section = active_section.prev();
            if (!next_section.length) return;

            next_tab = next_section.find('.sub').last();

            // change sections
            $('.wz-parent').removeClass('active');
            // close all other tabs
            $("#zoomWrap .tabs .sub").removeClass('active');
            $("#zoomWrap .tabs ul").slideUp('fast');

            next_section.find('ul').slideDown('fast');
            next_section.addClass('active');
        }

        $('.sub').removeClass('active');
        next_tab.addClass('active');

        $(".zoomForms .sub").hide();

        if (next_section && next_section.length) {
            $(".tab_content").hide();
            $(next_section.find('a').first().attr('href')).show();
        }

        $(next_tab.find('a').attr('href')).show();

        e.preventDefault();
    });

    $('#wpz-demo-content-icon').on('click', function(e){
        e.preventDefault();

        var toggle_id = $(this).attr('href'),
            toggle_section = $('.wz-parent.importexport');

        if (!toggle_section.length) return;

        // change sections
        $('.wz-parent').removeClass('active');

        // close all other tabs
        $("#zoomWrap .tabs .sub").removeClass('active');
        $("#zoomWrap .tabs ul").slideUp('fast');
        $(".zoomForms .sub").hide();
        $(".tab_content").hide();

        toggle_section.find('ul').slideDown('fast');
        toggle_section.addClass('active');
        toggle_section.find('a[href="'+toggle_id+'"]').parent().addClass('active');
        $('.zoomForms').find(toggle_id).show();
        $('.zoomForms').find(toggle_id).parents('.tab_content').show();

        Cookies.set( `${ WPZOOM_Theme_Options.themeName }_active_section`, toggle_section.find('a').first().attr('href') );
        Cookies.set( `${ WPZOOM_Theme_Options.themeName }_active_tab`, toggle_id );

        $('#misc_load_demo_content').trigger('click');
    });

});

/**
 * Autoselect export content on click
 */
jQuery(document).ready(function($) {
    $("#misc_export, #misc_export_widgets, #misc_debug").on('click', function() {
        this.focus();
        this.select();
    });
});

/**
 * Widgets import/export functionality
 */
jQuery(document).ready(function($) {
    $("#misc_load_default_widgets").on('click', function(e) {
        e.preventDefault();

        var loading = $("#zoomLoading");
        var success = $("#zoomSuccess");
        var fail    = $("#zoomFail");

        success.find('p').text('Widgets successfully loaded!');

        loading.fadeIn();

        var data = {
            type: 'widgets_default',
            '_ajax_nonce': $("#zoom-nonce").val()
        };

        var ask = confirm('Are you sure you want to restore default widgets? All previous changes made to widgets will be reset!');

        if (!ask) {
            loading.fadeOut();

            return false;
        }

        $("#misc_export_widgets").html('Please refresh this page and then get export data. Don\'t forget to save if you changed something.');

        wp.ajax.post(
            'wpzoom_widgets_default',
            data
        ).done(function () {

            loading.fadeOut();
            success.fadeIn();
            window.setTimeout(function () {
                success.fadeOut();
            }, 2000);

        }).fail(function () {

            loading.fadeOut();
            fail.fadeIn();
            window.setTimeout(function () {
                fail.fadeOut();
            }, 10000);

        });

        return false;
    });
});

/**
 * Ajax functionality
 */
jQuery(document).ready(function($) {
    $("#submitZoomForm").on('click', function() {
        $("#zoomForm").trigger('submit');
    });

    $("#zoomForm").on('submit', function() {
        var loading = $("#zoomLoading");
        var success = $("#zoomSuccess");
        var fail    = $("#zoomFail");

        success.find('p').text('Options successfully saved!');

        loading.fadeIn();

        function fData() {
            var values = $("#zoomForm").serialize();

            return values;
        }

        var data = {
            type: 'options',
            data: fData(),
            '_ajax_nonce': $("#zoom-nonce").val()
        };

        var ask;
        var wpzoom_import;

        if ($("#misc_import").val() != '') {
            ask = confirm('Are you sure you want to import these settings? All previous changes will be overwritten!');
            wpzoom_import = true;
        }

        if ($("#misc_import_widgets").val() != '') {
            ask = confirm('Are you sure you want to import these widgets? All previous changes will be overwritten!');
            wpzoom_import = true;
        }

        if (!ask && wpzoom_import) {
                loading.fadeOut();
                return false;
        }


        $("#misc_export").html('Please refresh this page and then get export data. Don\'t forget to save if you changed something.');
        $("#misc_export_widgets").html('Please refresh this page and then get export data. Don\'t forget to save if you changed something.');

        wp.ajax.post(
            'wpzoom_ajax_post',
            data
        ).done(function () {

            loading.fadeOut();
            success.fadeIn();
            window.setTimeout(function () {
                success.fadeOut();
                if (ask) {
                    location.href = location.href;
                }
            }, 2000);

        }).fail(function () {

            loading.fadeOut();
            fail.fadeIn();
            window.setTimeout(function () {
                fail.fadeOut();
            }, 10000);

        });

        return false;
    });

    $("#zoomReset").on('submit', function(event) {
        var ask = confirm('Are you sure you want to reset all settings? All changes made to theme options will be reset to default! Please think twice before doing this.');
        if (!ask) {
            event.preventDefault();
            return false;
        }
    });

});

/**
 * Color picker functionality
 */
jQuery(document).ready(function($) {
    $( '.colorSelector').each ( function () {
        var colourPicker = $(this).ColorPicker({

            color: $(this).next( 'input').attr( 'value' ),

            onShow: function (colpkr) {
                $(colpkr).fadeIn(500);
                return false;
            },
            onHide: function (colpkr) {
                $(colpkr).fadeOut(500);
                return false;
            },
            onChange: function (hsb, hex, rgb) {
                $(colourPicker).children( 'div').css( 'backgroundColor', '#' + hex);
                $(colourPicker).next( 'input').attr( 'value','#' + hex);
            }

        });

        $(this).children( 'div').css( 'backgroundColor', $(this).next( 'input').attr( 'value' ));
    });
});

/**
 * Media Library Upload functionality
 */
jQuery(document).ready(function($) {
    mlu = {

        removeFile: function () {
            $('.mlu_remove').on('click', function(event) {
                $(this).hide();
                $(this).parents().parents().children('.upload').attr('value', '');
                $(this).parents('.screenshot').animate({ 'opacity' : 0, 'height' : 0 });

                return false;
            });
        },

        recreateFileField: function () {
            $('input.file').each(function(){
                var uploadbutton = '<input class="upload_file_button" type="button" value="Upload" />';
                $(this).wrap('<div class="file_wrap" />');
                $(this).addClass('file').css('opacity', 0);
                $(this).parent().append($('<div class="fake_file" />').append($('<input type="text" class="upload" />').attr('id',$(this).attr('id')+'_file')).val( $(this).val() ).append(uploadbutton));

                $(this).on('change', function() {
                    $('#'+$(this).attr('id')+'_file').val($(this).val());
                });

                $(this).on('mouseout', function() {
                    $('#'+$(this).attr('id')+'_file').val($(this).val());
                });
            });

        },

        mediaUpload: function () {
            var formfield,
                formID,
                btnContent,
                uploader;

            $('input.upload_button').removeAttr('style');

            // On Click
            $('input.upload_button').on("click", function () {
                formfield = $(this).prev('input').attr('id');

                if (typeof(uploader) !== "undefined") {
                    uploader.close();
                }

                wp.media.model.settings.post.id = $(this).attr('rel');

                uploader = wp.media.frames.wpzoom_uploader = wp.media({
                    'title' : $(this).data('name'),
                    'library' : {
                        'type' : 'image',
                        'uploadedTo' : $(this).attr('rel')
                    },
                    'button' : {
                        'text' : 'Use this image'
                    },
                    'multiple' : false
                });

                uploader.on('select', function() {
                    var attachment = uploader.state().get('selection').first().toJSON();
                    var image = /(^.*\.jpg|jpeg|png|gif|ico*)/gi;

                    if (attachment.url.match(image)) {
                        btnContent = '<img src="'+attachment.url+'" alt="" /><a href="#" class="mlu_remove button">Remove Image</a>';
                    } else {
                        html = '<a href="'+attachment.url+'" target="_blank" rel="external">View File</a>';
                        btnContent = '<div class="no_image"><span class="file_link">'+html+'</span><a href="#" class="mlu_remove button">Remove</a></div>';
                    }

                    $('#' + formfield).val(attachment.url);
                    $("#" + formfield + "_image").html(btnContent).css({ 'height' : 'auto', 'opacity' : 1 });
                });

                uploader.open();

                return false;
            });
        }

    };

    mlu.removeFile();
    mlu.recreateFileField();
    mlu.mediaUpload();
});


/**
 * Custom jQuery radio buttons
 */
jQuery(document).ready(function($) {
    $('body').on('change', '.RadioClass', function() {
        if ($(this).is(":checked")) {
            $(this).parent().find(".RadioSelected:not(:checked)").removeClass("RadioSelected");
            $(this).next("label").addClass("RadioSelected");
        }
    });
});
