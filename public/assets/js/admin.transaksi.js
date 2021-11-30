
$('.switch-section').on('click',function (e) {
    $('#toggle').removeClass(`bg-${$('#toggle').attr('data-color')}`);
    $('#toggle').attr('data-color',$(this).data('color'));
    $('#toggle').addClass(`bg-${$(this).data('color')}`);
    $('.switch-section').removeClass('opacity-0');
    $(this).addClass('opacity-0');
    $('#toggle').html($(this).html());
    $('#toggle').css("transform", `translateX(${$(this).position().left}px)`);
})