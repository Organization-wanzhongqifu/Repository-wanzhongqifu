$(function() {
    $('#indexBanner').slick({
        arrows: false,
        dots: true,
        autoplay: true
    });
    // city
    $('#city_china01').citys({
        required: true,
        nodata: 'hidden',
        onChange: function(info) {
            $('input[name=service_province01]').val(info.province);
            $('input[name=service_city01]').val(info.city);
            $('input[name=service_district01]').val(info.area);
        }
    }, function(api) {
        var info = api.getInfo();
        $('input[name=service_province01]').val(info.province);
        $('input[name=service_city01]').val(info.city);
        $('input[name=service_district01]').val(info.area);
    });
    $('#city_china02').citys({
        required: true,
        nodata: 'hidden',
        onChange: function(info) {
            $('input[name=service_province02]').val(info.province);
            $('input[name=service_city02]').val(info.city);
            $('input[name=service_district02]').val(info.area);
        }
    }, function(api) {
        var info = api.getInfo();
        $('input[name=service_province02]').val(info.province);
        $('input[name=service_city02]').val(info.city);
        $('input[name=service_district02]').val(info.area);
    });
    //form validator
    $('#form01').validator().on('submit', function(e) {
        if (e.isDefaultPrevented()) {
            // handle the invalid form...
        } else {
            e.preventDefault();
        }
    })
    $('#form02').validator().on('submit', function(e) {
        if (e.isDefaultPrevented()) {
            // handle the invalid form...
        } else {
            e.preventDefault();
        }
    })
    $('#form03').validator().on('submit', function(e) {
        if (e.isDefaultPrevented()) {
            // handle the invalid form...
        } else {
            e.preventDefault();
        }
    })
    // placeholder-label
    $('.has-placeholder-label input').blur(function() {
        if (!$(this).val()) {
            $(this).next('label').removeClass('hide');
        } else {
            $(this).next('label').addClass('hide');
        }
    });
    // header-menu
    $(".mene-toggle").on("click", function(e) {
        $(".header-menu").toggleClass('active');
        $(document).one("click", function() {
            $(".header-menu").removeClass('active')
        });
        e.stopPropagation();
    });
    $(".header-menu").on("click", function(e) {
        e.stopPropagation();
    });
})