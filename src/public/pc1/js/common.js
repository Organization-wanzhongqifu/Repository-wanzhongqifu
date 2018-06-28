$(function(){
    $(document).on('click','.maskClose',function(){
        $('.mask,.maskBox').fadeOut(300);
    })
    
    $(document).on('click','.to-form',function(){
        $('.mask,.maskBox').fadeIn(300);
    })

    $('.maskTel').on('focus',function(){
        $('.redInfo').hide();
        $(this).attr('placeholder','');
    })

    $('.maskTel').on('blur',function(){
        var s = $(this).val().trim();
        var reg = /^1(3|4|5|7|8)[0-9]\d{8}$/;
        if(reg.test(s)){
            $('.concat').css('color','#333333');
            $(this).css('border-color','#ccc')
        }else{
            $('.concat').css('color','#a94442');
            $(this).css('border-color','#a94442')
        }
        if(!$(this).val()){
            $('.redInfo').show();
            $('.unpass').show();
            $(this).attr('placeholder','请留下您的手机号');
        }else{
            $('.redInfo').hide();
            $('.unpass').hide();
        }
        
    })

     $('.maskName').on('focus',function(){
        $(this).attr('placeholder','');
    })

    $('.maskName').on('blur',function(){
        if(!$(this).attr('placeholder')){
            $(this).attr('placeholder','请输入您的姓名')
        }
    })

    $('.redInfo').on('click',function(){
        $('.maskTel').focus();
    })

    //点击好的按钮触发事件
    $(document).on('click','.modal-footer .btn,.modal-header .close',function(){
        $('.mask,.maskBox').fadeOut(300);
        $(this).parents('.modal-dialog').fadeOut(300);
    })
    
    // 企业服务请求提交
    $('.maskItem .submit').on('click', function () {
        var tel = $('.maskTel').val().trim();
        var name = $('.maskName').val().trim();
        var reg = /^1(3|4|5|7|8)[0-9]\d{8}$/;
        if(!reg.test(tel)){
            $('.unpass').fadeIn(300);
            $('.maskTel').focus();
            return;
        }
        formPost(tel,name)
    });

    // 页面form提交
    $('.form-post .submit').on('click', function () {
        var tel = $(this).parents('.form-post').find('input').eq(1).val().trim();
        var name = $(this).parents('.form-post').find('input').eq(0).val().trim();
        var reg = /^1(3|4|5|7|8)[0-9]\d{8}$/;
        if(!tel){
           alertWarn('请输入手机号码');
            return;
        }
        if(!reg.test(tel)){
           alertWarn('请输入正确的手机号码')
            return;
        }
        formPost(tel,name,1)
    });

    $(document).on('click','.sure',function(){
        $('.form-tel').focus();
        $('.warn').remove();
    })

    function alertSuccess(s){
        var str = '<div class="warn"><img src="img/icon33.png" alt="">'+
        '<p>'+ s +'</p></div>';
        $('body').append(str);
        var iTimer = null;
        clearInterval(iTimer);
        iTimer = setTimeout(function(){
            $('.warn').remove();
        },1000)
    }



    //弹窗
    function alertWarn(s){
        var str = '<div class="warn"><img src="img/warn.png" alt="">'+
        '<p>'+ s +'</p></div>';
        $('body').append(str);

        var iTimer = null;
        clearInterval(iTimer);
        iTimer = setTimeout(function(){
            $('.warn').remove();
            $('.form-tel').focus();
        },1000)
    }


    //提交form表单功能
    function formPost(tel,name,form){
        var provider = {};
        provider.specification_id = '9';
        provider.service_id = '4';
        provider.service_province = '';
        provider.service_city = "";
        provider.service_district = '';
        provider.name = 'SEM' + name;
        provider.mobile = tel;
        provider.origin_from = 1;
        $.ajax({
            type: 'POST',
            url: '/adminApi/providers/submit',
            data: provider
        }).done(function (data) {
            if(form){
                alertSuccess('提交成功');
                $('.form-tel').val('');
                $('.form-name').val('');
            }else{
                $('.maskName,.maskTel').val('');
                $('.maskBox').fadeOut(300);
                $('.modal-dialog').fadeIn(300);
            }
        });
    }

})

   