<?php
$members = (new MemberModels())->getUserList($userId, $page);
$data = $members ?? [];
$members = $members['data'] ?? [];
?>

<div class="container mt-3">
    <div class="row">
        <div class="col-6 d-flex align-items-center">
            <?php if($userId != $this->userLogin->get('id')) : ?>
                <div class="back_listen_event cursor-pointer d-inline-block back_list">
                    <div class="img_go_back d-inline-block" style="width: 30px; position: relative; top: -6px">
                        <svg x="0px" y="0px" viewBox="0 0 52.502 52.502" style="enable-background:new 0 0 52.502 52.502;">
                            <g>
                                <path style="fill:#26B99A;" d="M21.524,16.094V4.046L1.416,23.998l20.108,20.143V32.094c0,0,17.598-4.355,29.712,16
                                c0,0,3.02-15.536-10.51-26.794C40.727,21.299,34.735,15.696,21.524,16.094z"/>
                                <path style="fill:#26B99A;" d="M51.718,50.857l-1.341-2.252C40.163,31.441,25.976,32.402,22.524,32.925v13.634L0,23.995
                                L22.524,1.644v13.431c12.728-0.103,18.644,5.268,18.886,5.494c13.781,11.465,10.839,27.554,10.808,27.715L51.718,50.857z
                                 M25.645,30.702c5.761,0,16.344,1.938,24.854,14.376c0.128-4.873-0.896-15.094-10.41-23.01c-0.099-0.088-5.982-5.373-18.533-4.975
                                l-1.03,0.03V6.447L2.832,24.001l17.692,17.724V31.311l0.76-0.188C21.354,31.105,23.014,30.702,25.645,30.702z"/>
                            </g>
                            <g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
                        </svg>
                    </div>
                    <span class="ml-2" style="font-size: 27px;">Back</span>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-6">
            <div id="paggination" class="float-right">
                <nav aria-label="Paggination">
                    <ul class="pagination">
                        <li class="page-item <?=$data['pageNow'] == 1 ? 'disabled not-allowed' : ''?>" <?=$data['pageNow'] == 1 ? 'disabled' : 'page="' . ($data['pageNow'] - 1) . '"'?>>
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true" <?=$data['pageNow'] == 1 ? '' : 'style="color: #007bff;"'?>>&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>
                        <?php for ($i = 1; $i <= $data['allPage']; $i++) :?>
                            <li class="page-item <?=$data['pageNow'] == $i ? 'disabled not-allowed' : ''?>" <?=$data['pageNow'] == $i ? 'disabled' : 'page="' . ($i) . '"'?>>
                                <a class="page-link" <?=$data['pageNow'] != $i ? 'style="color: #007bff"' : ''?> href="#"><?=$i?></a>
                            </li>
                        <?php endfor; ?>
                        <li class="page-item <?=$data['pageNow'] == $data['allPage'] ? 'disabled not-allowed' : ''?>" <?=$data['pageNow'] == $data['allPage'] ? 'disabled' : 'page="' . ($data['pageNow'] + 1) . '"'?>>
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true" <?=$data['pageNow'] == $data['allPage'] ? '' : 'style="color: #007bff;"'?>>&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <table class="table reset-color table-view-user bg-light text-center" border="1">
                <thead>
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">User Franchise</th>
                    <th scope="col" class="active_date">Active Date</th>
                    <th scope="col">Franchise</th>
                    <th scope="col">Direct Downline</th>
                </tr>
                </thead>
                <tbody>
                <?php $count = 1; foreach ($members as $member) : ?>
                    <tr class="hover_show_info_user" data-user='<?=json_encode($member)?>'>
                        <th scope="row" class="sttCount"><?=$count++?></th>
                        <td class="username getListUser <?=$member['downline'] == '0' ? 'disabled' : ''?>" data-id="<?=$member['id']?>"><?=$member['username']?></td>
                        <td class="active_date"><?=$member['active_date']?></td>
                        <td class="franchise"><?=$member['franchise']?></td>
                        <td class="downline"><?=$member['downline']?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="table_info_user reset-color">
    <ul>
        <li class="font-weight-bold text-uppercase">ID: <span class="info_user_id"></span></li>
        <li class="font-weight-bold text-uppercase">LEVEL: <span class="info_user_level highlight"></span></li>
        <li class="font-weight-bold">Active Date: <span class="info_user_active_date"></span></li>
        <li class="hr-line font-weight-bold">License Remaining: <span class="info_user_license_remaining"></span></li>
        <li>Fullname: <span class="info_user_fullname"></span></li>
        <li>Email: <span class="info_user_email"></span></li>
        <li class="hr-line">Phone: <span class="info_user_phone"></span></li>
        <li class="font-weight-bold">Enterprise: <span class="info_user_enterprise"></span></li>
    </ul>
</div>
<script>
    var TableMember = {
        getDataWithPage: (e) => {
            e.preventDefault();
            e.stopPropagation();
            if($(e.target).is('li')){
                $this = $(e.target);
            }else{
                $this = $(e.target).closest('li');
            }
            var page = $this.attr('page');
            TableMember.sendSearch({p : page, _is_call : '1', pagging : '1'});
        },
        sendSearch : (params) => {
            _ajax(base_url + '/home/userList', params, function(result){
                $(".area_content").html(result.html)
            })
        },
        showInfoUser : (e) => {
            if($(e.target).hasClass('edit_password_element') || $(e.target).closest('.edit_password_element').length > 0){
                return TableMember.hideInfoUser();
            }
            var $this = $(e.target).closest('tr');
            var dataUser = $this.attr('data-user');
            try{
                dataUser = JSON.parse(dataUser);
            }catch (e) {
                console.log(e);
                alert('Error Get User Info');
                return false;
            }
            $(".info_user_level").removeClass('startup entrepreneur enterprise');
            $(".info_user_id").text(dataUser.username);
            $(".info_user_level").text(dataUser.franchise).addClass(dataUser.franchise.toLowerCase());
            $(".info_user_active_date").text(dataUser.franchise_date);
            $(".info_user_license_remaining").text(dataUser.license_remaining);
            $(".info_user_fullname").text(dataUser.fullname);
            $(".info_user_email").text(dataUser.email);
            $(".info_user_phone").text(dataUser.phone);
            $(".info_user_enterprise").text(dataUser.enterprise);

            var objCss = {
                'left' : e.clientX + 10 + 'px'
            };
            if(window.screen.height - 500 < e.clientY){
                objCss['transform'] = 'translateY(-100%)';
                objCss['top'] = $this.offset().top - $(window).scrollTop() + 'px';
            }else{
                objCss['top'] = $this.offset().top - $(window).scrollTop() + $this.height() + 'px';
            }

            $(".table_info_user").removeAttr('style').css(objCss);
        },
        hideInfoUser : function(){
            $(".table_info_user").removeAttr('style').css({
                'top' : '-500px',
                'left' : '-500px'
            });
            return false;
        },
        getListUser : function(e){
            var $this = $(e.target);
            var id = $this.attr('data-id');
            var params = {
                userId : id,
                _is_call : '1'
            };
            if(!$this.hasClass('username')){
                if($this.hasClass('back_list') || $this.closest('.back_listen_event').hasClass('back_list')){
                    params['back'] = '1';
                }
            }
            TableMember.sendSearch(params);
        }
    };
</script>
<script>
    if(window.screen.width <= 767){
        $(".table-view-user").find(".active_date").each(function(){
            $(this).hide();
        });
    }
    $(".pagination").on('click', '.page-item:not(.disabled)', TableMember.getDataWithPage)
    $(".hover_show_info_user").on('mouseover', TableMember.showInfoUser);
    $(".hover_show_info_user").on('mouseleave', TableMember.hideInfoUser);
    $(".toggleActiveUser").on('click', TableMember.toggleActiveUser)
    $(".getListUser:not(.disabled)").on('click', TableMember.getListUser)
    $(".back_listen_event").on('click', TableMember.getListUser)
</script>