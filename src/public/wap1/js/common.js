$(function(){
    // var swiper = new Swiper('.swiper-container', {
    //   autoplay:1500,
    //   pagination: {
    //     el: '.swiper-pagination',
    //   },
    //   loop:true
    // });
    $(document).on('click','.maskClose',function(){
        $('.mask,.maskBox').fadeOut(300);
    })
    
    $(document).on('click','.to-form',function(){
        $('.mask,.maskBox').fadeIn(300);
    })

    $('.maskTel').on('focus',function(){
        $('.redInfo').hide();
        $(this).attr('placeholder','')
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
            $('.unpass').show();
            $('.redInfo').show();
            $(this).attr('placeholder','请留下您的手机号')
        }else{
            $('.redInfo').hide();
            $('.unpass').hide();
        }
    })



     $('.maskName').on('focus',function(){
        $(this).attr('placeholder','')
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
        var s = $('.maskTel').val().trim();
        var reg = /^1(3|4|5|7|8)[0-9]\d{8}$/;
        var name = $('.maskName').val().trim();
        if(!s){
            alertError('请输入手机号码');
            $(this).parents('.form-submit').find('input').eq(1).focus();
            return;
        }
        if(!reg.test(s)){
            $('.unpass').fadeIn(300);
            $('.maskTel').focus();
            return;
        }else{
        	formPost(name,s);
        }
        
    });

    $(document).on('click','.form-submit .submit',function(){
    	var name = $(this).parents('.form-submit').find('input').eq(0).val().trim();
    	var tel = $(this).parents('.form-submit').find('input').eq(1).val().trim();
    	var reg = /^1(3|4|5|7|8)[0-9]\d{8}$/;
        if(!tel){
            alertError('请输入手机号码');
            $(this).parents('.form-submit').find('input').eq(1).focus();
            return;
        }
    	if(!reg.test(tel)){
            alertError('您输入手机号有误，请检查！');
            $(this).parents('.form-submit').find('input').eq(1).focus();
            return;
        }else{
        	formPost(name,tel);
        }
        
    })
    //弹窗
    function alertError(s){
    	var str = '<div class="modal-error">' +
            '<img src="img/error.png" alt="">' +
            '<p>'+ s +'</p>';
        '</div>';
        $('body').append(str);
        var num = null;
        clearInterval(num);
        num = setInterval(function(){
        	$('.modal-error').remove();
        	clearInterval(num)
        },1000)
    }

    function formPost(name,tel){
    	var provider = {};
        provider.specification_id = '9';
        provider.service_id = '4';
        provider.service_province = '';
        provider.service_city = '';
        provider.service_district = '';
        provider.name = 'SEM-M' + name;
        provider.mobile = tel;
        provider.origin_from = 1;
        $.ajax({
            type: 'POST',
            url: '/adminApi/providers/submit',
            data: provider
        }).done(function (data) {
            $('.form-submit').find('input').val('');
            $('.maskName,.maskTel').val('');
            $('.maskBox').fadeOut(300);
            $('.modal-dialog').fadeIn(300);
        });
    }

})