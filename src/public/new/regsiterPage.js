$(function () {
    func.remain();
})

function Imain() { };


/**
 *desc:首页--发布需求鼠标移入移出事件
 *@param void;
 *@return void;
 */

Imain.prototype.remain = function () {
    var _this = this;
    this.selectShen();
    this.houseHover();
    this.banner();
}

Imain.prototype.selectShen = function () {
    var shengfen = new Array;

    shengfen = ["北京市", "天津市", "河北省", "山西省", "内蒙古自治区", "辽宁省", "吉林省", "黑龙江省", "上海市",
"江苏省", "浙江省", "安徽省", "福建省", "江西省", "山东省", "河南省", "湖北省", "湖南省", "广东省",
"广西壮族自治区", "海南省", "重庆市", "四川省", "贵州省", "云南省", "西藏自治区", "陕西省",
"甘肃省", "青海省", "宁夏回族自治区", "新疆维吾尔自治区", "香港特别行政区",
"澳门特别行政区", "台湾省", "其它"];

    for (var s = 0; s < shengfen.length; s++) {
        $("#add_shengfen").append("<li>"+shengfen[s]+"</li>");
    }
};

Imain.prototype.banner = function () {
    var a = 1, c = 1;
    var banner_length = $(".profession_scroll li").length;
    $(".profession_scroll li").eq(1).find(".person_information").stop(1, 0).css({ "bottom": "0px" });
    $(".profession_scroll ul").css("width", banner_length * 385);
    $(".pro_leftBlank").html($(".profession_scroll li").eq(banner_length - 2).html());
    $(".pro_rightBlank").html($(".profession_scroll li").eq(1).html());
    //var banner_auto = setInterval(banner_scroll, 2800);

    function banner_scroll() {
        if (a == banner_length - 1) {
            a = 0;
        } else {
            a++;
        }
        $(".profession_scroll ul").stop(1, 0).animate({ "margin-left": -a * 385 });
        $(".profession_scroll li").eq(a).find(".person_information").stop(1, 0).animate({ "bottom": "0px" });
        $(".profession_scroll li").eq(a).siblings("li").find(".person_information").stop(1, 0).animate({ "bottom": "-50px" });
    }
    $(".clear_click").hover(function () {
        //clearInterval(banner_auto);
        //banner_auto = "";
    }, function () {
        //banner_auto = setInterval(banner_scroll, 2800);
    })
    $(".profession_leftBtn").click(function () {
        if (a == 0) {
            a = banner_length - 3;
        } else {
            a--;
        }

        if (c == 1) {
            c = banner_length - 2;
        } else {
            c--;
        }
        $(".profession_scroll ul").stop(1, 0).animate({ "margin-left": -a * 385 }, function () {
            setTimeout(banner_s, 100);
            if (a == 0) {
                $(".profession_scroll ul").stop(1, 0).css({ "margin-left": -(banner_length - 2) * 385 });
                a = 3;
            }
        });
    })
    $(".profession_rightBtn").click(function () {
        if (a == banner_length - 1) {
            a = 2;
        } else {
            a++;
        }
        if (c == banner_length - 2) {
            c = 1;
        } else {
            c++;
        }
        $(".profession_scroll ul").stop(1, 0).animate({ "margin-left": -a * 385 }, function () {
            setTimeout(banner_s, 100);
            if (a == banner_length - 1) {
                $(".profession_scroll ul").stop(1, 0).css({ "margin-left": "-385px" });
                a = 1;
            }
        });

    })

    function banner_s() {
        $(".profession_scroll li").eq(c).find(".person_information").stop(1, 0).animate({ "bottom": "0px" });
        $(".profession_scroll li").eq(c).siblings("li").find(".person_information").stop(1, 0).animate({ "bottom": "-50px" });
    }

};

Imain.prototype.houseHover = function () {
    $(".select_click").click(function () {
        $(".select_list ul").stop(1, 0).show().animate({ "height": "300px" });
        $(".list_btn").stop(1, 0).addClass("chose");
    })

    $(".list_btn").click(function () {
        if ($(this).hasClass("chose")) {
            $(this).stop(1, 0).removeClass("chose");
            $(".select_list ul").stop(1, 0).animate({ "height": "0px" }).hide();
        } else {
            $(this).stop(1, 0).addClass("chose");
            $(".select_list ul").stop(1, 0).show().animate({ "height": "300px" });
        }
    })

    $(".select_list ul").mouseleave(function () {
        $(".select_list ul").stop(1, 0).animate({ "height": "0px" }).hide();
        $(".list_btn").stop(1, 0).removeClass("chose");
    })

    $(".select_list li").click(function () {
        $(".select_list ul").stop(1, 0).animate({ "height": "0px" }).hide();
        $(".select_click").stop(1, 0).text($(this).text());
        $(".list_btn").stop(1, 0).removeClass("chose");
    })

    $(".xm_li").hover(function () {
        $(this).find("a").stop(1, 0).animate({ "left": "10px" });
    }, function () {
        $(this).find("a").stop(1, 0).animate({ "left": "0px" });
    })
    $(".xiangmu_person").hover(function () {
        $(this).find("i").stop(1, 0).animate({
            "width": "98%",
            "height": "98%"
        })
    }, function () {
        $(this).find("i").stop(1, 0).animate({
            "width": "100%",
            "height": "100%"
        })
    })
    $(".professional_left li").hover(function () {
        $(this).find(".p_l_line").stop(1, 0).animate({
            "height": "89px",
            "top": "0px"
        });

    }, function () {
        $(this).find(".p_l_line").stop(1, 0).animate({
            "height": "0px",
            "top": "45px"
        });

    })

    $(".youshi_con li").hover(function () {
        $(this).find("a").stop(1, 0).animate({ "left": "10px" });
    }, function () {
        $(this).find("a").stop(1, 0).animate({ "left": "0px" });
    })

    $(".service li").hover(function () {
        $(this).find(".service_describe").stop(1, 0).animate({ "top": "10px" });
        var _thisLine = $(this).find(".service_line");
        _thisLine.stop(1, 0).animate({ "height": "0px" }, function () {
            _thisLine.stop(1, 0).animate({ "height": "154px" });
        });
    }, function () {
        $(this).find(".service_describe").stop(1, 0).animate({ "top": "0px" });
        //$(this).find(".service_line").stop(1, 0).animate({ "height": "154px" });
    })

};




var func = new Imain();







