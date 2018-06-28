$(function(){
	var swiper = new Swiper('.swiper-container', {
	  autoplay:true,
	  pagination: {
	    el: '.swiper-pagination',
	  },
	  loop:true
	});
	// addressInit('prov', 'city', 'dist', '北京', '', '东城区');
    $(document).on('click','.maskClose',function(){
        $('.mask,.maskBox').fadeOut(300);
    })
    
    $(document).on('click','.entrust,.gs-urgent,.daili-more,.to-form',function(){
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
        var type = window.location.href;
        var zxs = $('.city').val();
        var s = $('.maskTel').val().trim();
        var reg = /^1(3|4|5|7|8)[0-9]\d{8}$/;
        var semName = '';
        if(!reg.test(s)){
            $('.unpass').fadeIn(300);
            $('.maskTel').focus();
            return;
        }
        if (!$(this).hasClass('disabled')) {
            var provider = {};
            if(type.indexOf('/gs.html') > -1){
                provider.specification_id = '9';
                provider.service_id = '4';
            }
            if(type.indexOf('/daili.html') > -1){
                provider.specification_id = '23';
                provider.service_id = '1';
            }
            provider.service_province = '';
            provider.service_city = '';
            provider.service_district = '';
            provider.name = 'SEM-M'+$('.maskName').val();
            provider.mobile = $('.maskTel').val();
            provider.origin_from = 1;
            $.ajax({
                type: 'POST',
                url: '/adminApi/providers/submit',
                data: provider
            }).done(function (data) {
                $('.maskName,.maskTel').val('');
                $('.maskBox').fadeOut(300);
                $('.modal-dialog').fadeIn(300);
            });
        }
    });
})
	