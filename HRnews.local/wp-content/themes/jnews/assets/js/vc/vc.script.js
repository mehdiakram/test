!function(e){"use strict";var t=function(e,t){if(!e.length||e.length<3)return t();wp.ajax.send(this.ajax,{data:{query:e,nonce:this.nonce}}).done((function(e){t(e)}))};function n(e){return"<i class='ivc fa "+e.id.toLowerCase()+"'/></i>"+e.text}e(".vc-select-wrapper").each((function(){var n,i,a=e(this).data("ajax"),c=e(this).data("multiple"),o=e(this).data("nonce");if(c>1){var s=e(this).find(".data-option").text(),r=JSON.parse(s);n=e(this).find("input"),i={plugins:["drag_drop","remove_button"],multiple:c,hideSelected:!0,persist:!0,options:r,render:{option:function(e){return"<div><span>"+e.text+"</span></div>"}}}}else n=e(this).find("select"),i={allowEmptyOption:!0};""!==a&&(i.load=t.bind({ajax:a,nonce:o}),i.create=!0,i.onItemAdd=function(){if("jeg_find_review"===a){var e=this.items;if(e.length>1)for(var t=0;t<e.length;t++)this.removeItem(e[t]),this.refreshOptions()}}),e(n).selectize(i)})),e(".number-input-wrapper input[type=text]").each((function(){var t=e(this).attr("min"),n=e(this).attr("max"),i=e(this).attr("step");e(this).spinner({min:t,max:n,step:i})})),e(".wp-tab-panel.vc_checkblock").each((function(){var t=this,n=e(t).find(".wpb-input");e(this).find(".checkblock").on("click",(function(){var i=[];e(t).find(".checkblock").each((function(){e(this).is(":checked")&&i.push(e(this).val())})),e(n).val(i)}))})),window.vc.atts.radioimage={init:function(t,n){e(".radio-image-wrapper label input",n).change((function(){e(this).closest(".radio-image-wrapper").find(".wpb_vc_param_value").val(e(this).val()).trigger("change")}))}},e(".slider-input-wrapper").each((function(){var t=e(this),n=t.find("input[type=range]");n.on("mousedown",(function(){e(this).on("mousemove",(function(){t.find(".jnews_range_value .value").text(e(this).val())}))})),n.on("click",(function(){t.find(".jnews_range_value .value").text(e(this).val())})),t.find(".jnews-slider-reset").on("click",(function(){var n=e(this).parent().find("input"),i=n.data("reset_value");n.val(i),n.change(),t.find(".jnews_range_value .value").text(i)}))})),e(".input-uploadfile").each((function(){var t=e(this).find('input[type="text"]');e(this).find(".selectfileimage").on("click",(function(e){e.preventDefault(),custom_uploader=wp.media.frames.file_frame=wp.media({multiple:!1}),custom_uploader.on("select",(function(){attachment=custom_uploader.state().get("selection").first().toJSON();var e=attachment.url;t.val(e)})),custom_uploader.open()}))})),e(".sectionid-input > input").blur((function(){var t=e(this).val(),n=t.toLowerCase().replace(/ /g,"-").replace(/[^\w-]+/g,"");e(this).val(n)})),e(".sectionid-input > select").each((function(){e(this).select2({placeholder:"Select",allowClear:!0,formatResult:n,formatSelection:n,escapeMarkup:function(e){return e}})})),e(".jnews_token_access.facebook").on("click",(function(t){t.preventDefault();var n,i=e(this),a=i.parents("#vc_edit-form-tab-0"),c={client_id:a.find("input.fb_id").val(),client_secret:a.find("input.fb_secret").val(),grant_type:"client_credentials"};e.ajax({url:"https://graph.facebook.com/oauth/access_token",data:c,dataType:"json",type:"POST",beforeSend:function(e){i.parent().find(".jnews-spinner").addClass("active")}}).done((function(e,t,i){n=e.access_token,a.find("input.fb_key").val(n)})).fail((function(e,t,n){window.alert("Info Message: "+n)})).always((function(e,t,n){i.parent().find(".jnews-spinner").removeClass("active")}))})),e(".jnews_instagram_access_token").on("click",(function(t){t.preventDefault();var n=e(this),i=n.parents(".vc_edit-form-tab.vc_active"),a=n.attr("href"),c="https://api.instagram.com/oauth/authorize/?client_id="+i.find("input.clientid").val()+"&redirect_uri="+a+"&response_type=token";window.open(c,"_blank").focus()}))}(window.jQuery);