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
            post.on('click', edit_funct.on_add_btn);
        });
    },
    
    'on_cancel' : function(){
        
    },
    
    'on_add_btn' : function(){
        alert('PREVED')
    }
    
};

