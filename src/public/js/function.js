function dateMinus(sDate){
    var sdate = new Date(sDate.replace(/-/g, "/"))
    var now = new Date()
    var days = now.getTime() - sdate.getTime()
    return parseInt(days / (1000 * 60 * 60 * 24))
}

function computedAge(dateStr) {
    var days = dateMinus(dateStr)
    if(days <= 0) {
        return '-'
    }

    if(days / 30 < 1) {
        return '1个月'
    }

    if(days / 365 < 1) {
        return Math.ceil(days / 30) + '个月'
    } else {
        var year = Math.floor(days / 365)
        var month = Math.ceil((days - year * 365) / 30)
        return year + '岁零' + month + '个月'
    }
}

function intention(intention) {
    if (intention === '-') return '-';
    var intentions = ['', '亲子课半年卡', '亲子课一年卡', '亲子课两年卡', '育护班半年卡', '育护班一年卡', '小时育护', '活动'];
    var index = intention.split(',');
    var intention_show = '';
    for(var i = 0; i < index.length; i++) {
        intention_show += intentions[index[i]];
        intention_show += ',';
    }
    return intention_show.substring(0, intention_show.length - 1)
}

function customer_level1(level)
{
    var levels = ['进行中', '成单', '丢单', '作废'];
    return levels[level];
}

function customer_level2(level) {
    var levels = ['待处理', '未试听', '已试听', '一次追单', '二次追单', '已付定金', '已付余款', '已付全款', '已退定金', '已退全款', '已丢单', '已退会员', '已作废'];
    return levels[level];
}

function course_level(level) {
    var courses = ['', '0-6个月', '6-12个月', '12-18个月', '18-24个月', '24-30个月', '30-36个月'];
    var str = '';
    eval(level).forEach(function (e) {
        str += courses[e];
        str += ',';
    });
    return str.substr(0, str.length - 1);
}