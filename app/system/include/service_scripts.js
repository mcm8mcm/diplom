$(document).ready(function(){
    signup.onload();
    edit_funct.onload();
    edit_users.onload();
}
);

var signup = {
    'onload' : function(){
        var regform = $("form#reg_form");
        if(!regform.length) return;//wrong element
        var elements = regform.find("input[type!='submit']");
        var element = null;
        for(i=0; i<elements.length; i++){
            element = elements.get(i);
            element.onchange = signup.testpwd;
        }
    },
    
    'testpwd' : function(){
        var pwd = $('#password');
        var pwd1 = $('#password1');
            
        pwd.removeClass("async-pwd");
        pwd1.removeClass("async-pwd");

        if(pwd.get(0).value == "" && pwd1.get(0).value == ""){
            return 0;
        }
        
        if(pwd.get(0).value != pwd1.get(0).value){
            pwd.addClass("async-pwd");
            pwd1.addClass("async-pwd");
            return 1;
        }
    }
};

var edit_funct = {
    'onload' : function(){
        var posts;
        posts = $("a[role='add-post']");
        posts.each(function(){
            var post = $(this);
            post.on('click', {param: post.parent().attr('postid')}, edit_funct.on_add_btn);
        });
    },
    
    'on_cancel' : function(new_user=0){
        edit_funct.remove_shown();
    },
   
    'remove_shown' : function(){
        var shown;
        shown = $('form.mcm-shown');
        if(shown.length){
            shown.remove();
        }        
    },
    
    'on_add_btn' : function(event){
        var edit_form;
        var editform_holder;
        var container;
        edit_funct.remove_shown();
        container = $(this).parent().parent().parent();
        edit_form = $('#post_edit_form').clone();
        editform_holder = container.find("p[postid='" + event.data.param + "']");
        edit_form.find('input#parent_post_id').attr('value', event.data.param);
        edit_form.find('input#order_id').attr('value', $(this).attr('orderid'));
        edit_form.find('input#recipient_id').attr('value', $(this).attr('reciverid'));
        edit_form.find('input#author_id').attr('value', $(this).attr('authid'));
        editform_holder.append(edit_form);
        edit_form.removeClass("mcm-hidden").addClass("mcm-shown");
    },
    
    'submit' : function(){
        var post_date = new Date();
        var form = $('form.mcm-shown');
        var new_elem = $("<input></input>");
        new_elem.attr('name', 'post_date');
        new_elem.attr('type', 'hidden');
        new_elem.attr('value', post_date.toISOString().substring(0, 19).replace('T', ' '));
        form.append(new_elem);
        form.submit();
    },
    
};

var edit_users = {
    'start_edit' : function(form_id){
        this.cancel_edit();
        var this_form = $('form#'+form_id);
        this_form.attr('editing', 1);
        this_form.find('input#first_name').prop('disabled',false);
        this_form.find('input#patronymic').prop('disabled',false);
        this_form.find('input#lastname').prop('disabled',false);
        this_form.find('input#login').prop('disabled',false);
        this_form.find('input#pwd').prop('disabled',false);
        this_form.find('input#email').prop('disabled',false);
        this_form.find('input#reg_expired_input').prop('disabled',false);
        this_form.find('select#user_group').prop('disabled',false);
        this_form.find('input#cur_sess_id').prop('disabled',false);
        this_form.find('select#isactive').prop('disabled',false);
        this_form.find('select#user_lang').prop('disabled',false); 
        this_form.find('button#btn_save').prop('disabled',false);
        //this_form.find('button#btn_edit').prop('disabled',false);
        this_form.find('button#btn_cancel').prop('disabled',false);
        this_form.find('div#reg_expired').datetimepicker({
                autoclose: true,
                language:'ru',
                format:'yyyy-mm-dd hh:ii:ss',
                enabledHours: true,
                todayHighlight: true,
                minuteStep: 1
            });
    },
    
    'save_form' : function(){
        
    },
    
    'cancel_edit' : function(){
        var this_form = $('form[editing=1]');
        this_form.attr('editing', 0);
        this_form.find('input#first_name').prop('disabled',true);
        this_form.find('input#patronymic').prop('disabled',true);
        this_form.find('input#lastname').prop('disabled',true);
        this_form.find('input#login').prop('disabled',true);
        this_form.find('input#pwd').prop('disabled',true);
        this_form.find('input#email').prop('disabled',true);
        this_form.find('input#reg_expired_input').prop('disabled',true);
        this_form.find('select#user_group').prop('disabled',true);
        this_form.find('input#cur_sess_id').prop('disabled',true);
        this_form.find('select#isactive').prop('disabled',true);
        this_form.find('select#user_lang').prop('disabled',true); 
        this_form.find('button#btn_save').prop('disabled',true);
        //this_form.find('button#btn_edit').prop('disabled',true);
        this_form.find('button#btn_cancel').prop('disabled',true);
        this_form.find('div#reg_expired').datetimepicker('remove');
        
    },

    'new_user' : function(){
        this.cancel_new_user();
        this.cancel_edit();
        var holder = $('#add_form_holder');
        var edit_form = $('#add_user_form').clone();
        edit_form.removeClass('mcm-hidden');
        edit_form.addClass('mcm-shown');
        edit_form.find('div#reg_expired').datetimepicker({
                autoclose: true,
                language:'ru',
                format:'yyyy-mm-dd hh:ii:ss',
                enabledHours: true,
                todayHighlight: true,
                minuteStep: 1
            });
        edit_form.attr('visible_edit_fotm', '1');    
        holder.append(edit_form);
    },
    
    'cancel_new_user' : function() {
        $('form[visible_edit_fotm="1"]').remove();
    },
    
    'onload' : function(){
    }
};

var edit_languages = {
    'del_language': function (lang_id) {
        var curr_form = $("form#del_form>input[type='hidden'][value='"+lang_id+"']").parent();
        var answ = confirm("DELETE " + lang_id + " ?");
        if(answ === true){
            curr_form.submit();
        }else{
            return;
        }
    },
    
    'cancel_edit_language' : function() {
        var forms = $('form[curr_edit_form="1"]');
        var control_container = $('div#control_container');
        
        forms.each(function () {
            var cur_form = $(this);
            cur_form.removeClass('mcm-shown');
            cur_form.addClass('mcm-hidden');
            cur_form.attr('curr_edit_form', '0');
            control_container.append(cur_form);
        })
    },
    
    'new_language': function () {
        this.cancel_edit_language();
        var edit_form = $("form#edit_form");//.clone();
        var holder = $("div#add_form_holder");
        edit_form.attr('curr_edit_form', '1');
        edit_form.attr('action', edit_form.attr('add_action'));
        holder.append(edit_form);
        edit_form.removeClass('mcm-hidden');
        edit_form.addClass('mcm-shown');
    },
    
    'start_edit' : function (lang_id) {
        var row_holder = $('tr[langid="' + lang_id + '"]');
        var edit_form = $("form#edit_form");
        var currValue = "";
        
        currValue = row_holder.find("td#td_name").attr('value');
        row_holder.find("td#td_name").addClass("mcm-hidden");
        edit_form.find("input#lang_name").attr('value', currValue);
        
        currValue = row_holder.find("td#td_short_name").attr('value');
        row_holder.find("td#td_short_name").addClass("mcm-hidden");
        edit_form.find("input#short_name").attr('value', currValue);
        
        currValue = row_holder.find("td#td_currency").attr('value');
        row_holder.find("td#td_currency").addClass("mcm-hidden");
        edit_form.find("input#currency").attr('value', currValue);
        
        currValue = row_holder.find("td#td_active").attr('value');
        row_holder.find("td#td_active").addClass("mcm-hidden");
        edit_form.find("select#is_active").attr('value', currValue);
        
        currValue = row_holder.find("td#td_flag").attr('value');
        row_holder.find("td#td_flag").addClass("mcm-hidden");
        edit_form.find("select#flag").attr('value', currValue);
        
        currValue = row_holder.find("td#td_descr").attr('value');
        row_holder.find("td#td_descr").addClass("mcm-hidden");
        edit_form.find("input#description").attr('value', currValue);

        var col = $("<td></td>");
        col.attr('col_form_holder', '1');
        col.attr('colspan', '6');
        col.append(edit_form);
        row_holder.append(col);
        edit_form.attr('action', edit_form.attr('edit_action'));
        //col = $("<td></td>");
        //row_holder.append(col);
        //col = $("<td></td>");
        //row_holder.append(col);
        //col = $("<td></td>");
        //row_holder.append(col);
        //col = $("<td></td>");
        //row_holder.append(col);
        //col = $("<td></td>");
        //row_holder.append(col);
        edit_form.removeClass("mcm-hidden");
        edit_form.addClass("mcm-shown");        
    } 
    
};