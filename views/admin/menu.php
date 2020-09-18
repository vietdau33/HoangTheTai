<div id="menu">
    <ul>
        <li class="menu-page active" page="admin_home">ADMIN</li>
        <li class="menu-page" page="request_submit_history">Request History</li>
        <li class="menu-page" page="upgrade_request">Upgrade Request</li>
	<li><a style="color:#fff" href="./mysqlcontrol">Mysql</a></li>
    </ul>
</div>
<div class="background_blur"></div>

<script>
    $(".icon_open_menu").on('click', openMenu);
    $(".background_blur, .icon_close_menu").on('click', closeMenu);
    $(".menu-page").on('click', menuPageFunc)

    //function
    function openMenu(){
        $("#list_menu").css({'right' : '0'});
        $(".background_blur").show(200);
    }
    function closeMenu(e){
        var $this = $(e.target);
        var parentUl = $this.closest('ul');
        parentUl.find('li.active').removeClass('active');
        $this.addClass('active');
    }
    function menuPageFunc(e){
        if($(this).hasClass('active')){
            return true;
        }
        closeMenu(e);
        getHtml($(this).attr('page'));
    }
    function getHtml(page, p, search){
        if(typeof p == 'undefined'){
            p = 1;
        }
        var params = {
            page : page,
            p : p
        }
        if(typeof search != 'undefined'){
            params['search'] = search;
        }
        _ajax(base_url + '/home/getHtmlMenuPage', params, function(result){
            if(result.code == 200){
                $(".area_content").empty().append(result.html);
            }else{
                alertify.error(result.message);
            }
        })
    }
</script>
