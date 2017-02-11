$(document).ready(function(){
    signup.onload();
    edit_funct.onload();
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
    
    'on_cancel' : function(){
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
    }
};

