$(function() {
    jQuery("#indexBanner").slide({
        mainCell: ".bd ul",
        autoPlay: true
    });
    jQuery(".hot-slide").slide({
        mainCell: ".bd ul",
        autoPage: true,
        effect: "left",
        autoPlay: true,
        vis: 3
    });
    jQuery(".menu-intro").slide({
        type: "menu",
        titCell: ".mainCate",
        targetCell: ".subCate",
        delayTime: 0,
        triggerTime: 0,
        defaultPlay: false,
        returnDefault: true
    });
    $('.menu-warp').hover(function() {
        $('.menu-list').toggleClass('hide')
    });
    // city
    $('#city_china').citys({
        required: true,
        nodata: 'hidden',
        onChange: function(info) {
            $('input[name=service_province]').val(info.province);
            $('input[name=service_city]').val(info.city);
            $('input[name=service_district]').val(info.area);
        }
    }, function(api) {
        var info = api.getInfo();
        $('input[name=service_province]').val(info.province);
        $('input[name=service_city]').val(info.city);
        $('input[name=service_district]').val(info.area);
    });
    //form validator
    $('#form01').validator({
        focus:false
    }).on('submit', function(e) {
        if (e.isDefaultPrevented()) {
            // handle the invalid form...
        } else {
            e.preventDefault();
            $('#form01').find("input[type=text], textarea, select").val("");
            $('#Modal01').modal('show').find('.submit').text('立即核名');


        }
    })
    $('#form02').validator({
        focus:false
    }).on('submit', function(e) {
        if (e.isDefaultPrevented()) {
            // handle the invalid form...
        } else {
            e.preventDefault();
            $('#form02').find("input[type=text], textarea, select").val("");
            $('#Modal01').modal('hide');
        }
    })
    $('#form03').validator({
        focus:false
    }).on('submit', function(e) {
        if (e.isDefaultPrevented()) {
            // handle the invalid form...
        } else {
            $('#form03').find("input, textarea, select").val("");
            e.preventDefault();
        }
    })
    // placeholder-label
    $('.has-placeholder-label input').blur(function() {
        if (!$(this).val()) {
            $(this).next('label').removeClass('hide');
        }else{
            $(this).next('label').addClass('hide');
        }
    });
    //hot-city
    $('.hot-city .select-btn').click(function() {
        $(".hot-city").toggleClass('active');
        $(document).one("click", function() {
            $(".hot-city").removeClass('active')
        });
        e.stopPropagation();
    })
    $('.hot-city').on("click", function(e) {
        e.stopPropagation();
    });
    $('.hot-city .dropdown-box a').click(function() {
        var $dropValue = $(this).html();
        $('.hot-city').find('.form-control').val($dropValue);
        return false;
    });


})