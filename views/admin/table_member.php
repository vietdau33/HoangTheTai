<?php
    $page = $page ?? '1';
    $search = $search ?? null;
    $getUserAdmin = $getUserAdmin ?? false;
    $members = (new MemberModels())->getMember($page, $search, $getUserAdmin);
    $data = $members ?? [];
    $members = $members['data'] ?? [];
?>

<div class="row">
    <div class="col-6 search-user">
        <input type="text" class="form-control d-inline-block username_search_input" style="width: 85%" value="<?=$search ?? ''?>" title="<?=__('username_input')?>" placeholder="<?=__('username_input')?>">
        <button class="btn-custom ml-3 w-auto pl-3 pr-3 buttonSearchUsername" style="padding: 3px 0"><?=__('search')?></button>
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
<table class="table table-view-user bg-light text-center" border="1">
    <thead>
    <tr>
        <th scope="col">STT</th>
        <th scope="col"><?=__('username')?></th>
        <th scope="col"><?=__('franchise')?></th>
        <th scope="col"><?=__('franchise_date')?></th>
        <th scope="col"><?=__('license')?></th>
        <th scope="col"><?=__('license_remaining')?></th>
        <th scope="col" colspan="2"><?=__('edit')?></th>
    </tr>
    </thead>
    <tbody>
    <?php $count = 1; foreach ($members as $member) : ?>
        <tr class="hover_show_info_user" data-user='<?=json_encode($member)?>'>
            <th scope="row" class="sttCount"><?=$count++?></th>
            <td class="username"><?=$member['username']?></td>
            <td class="franchise"><?=$member['franchise']?></td>
            <td class="franchise_date"><?=$member['franchise_date']?></td>
            <td class="license"><?=$member['license']?></td>
            <td class="license_remaining"><?=$member['license_remaining']?></td>
            <td class="edit_password_element p-0 align-middle">
                <button data-id="<?=$member['id']?>" class="btn <?=$member['active'] == '0' ? 'btn-success' : 'btn-danger'?> toggleActiveUser" style="color: #fff;"><?=$member['active'] == '0' ? 'Active' : 'Deactive'?></button>
            </td>
            <td class="edit_password_element">
                <a data-id="<?=$member['id']?>" class="editPassword" style="color: #005cbf" href="<?=BASE_URL?>/member/edit_password"><?=__('edit_password')?></a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<div class="table_info_user">
    <ul>
        <li class="font-weight-bold text-uppercase">ID: <span class="info_user_id"></span></li>
        <li class="font-weight-bold text-uppercase">LEVEL: <span class="info_user_level highlight"></span></li>
        <li class="font-weight-bold">Active Date: <span class="info_user_active_date"></span></li>
        <li class="hr-line font-weight-bold">License Remain: <span class="info_user_license_remaining"></span></li>
        <li>Fullname: <span class="info_user_fullname"></span></li>
        <li>Email: <span class="info_user_email"></span></li>
        <li class="hr-line">Phone: <span class="info_user_phone"></span></li>
        <li class="font-weight-bold">Enterprise: <span class="info_user_enterprise"></span></li>
    </ul>
</div>
<script>
    var TableMember = {
        searchUser : () => {
            var username = $(".username_search_input").val().trim();
            TableMember.sendSearch({username : username});
        },
        getDataWithPage: (e) => {
            e.preventDefault();
            e.stopPropagation();
            if($(e.target).is('li')){
                $this = $(e.target);
            }else{
                $this = $(e.target).closest('li');
            }
            var page = $this.attr('page');
            var username = $(".username_search_input").val().trim();
            TableMember.sendSearch({username : username, page : page});
        },
        sendSearch : (params) => {
            _ajax(base_url + '/member/adminGetUser', params, function(result){
                if(result.code != 200){
                    alertify.error(result.message);
                    return false;
                }
                alertify.success(result.message);
                $("#table_member_area").html(result.html)
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
        toggleActiveUser : (e) => {
            var $this = $(e.target);
            var id = $this.attr('data-id');
            _ajax(base_url + '/member/toggleActiveUser', {id : id}, function(result){
                if(result.code != 200){
                    alertify.error(result.message);
                    return false;
                }
                alertify.success(result.message);
                $this.removeClass('btn-success btn-danger');
                $this.addClass(result.active == '1' ? 'btn-danger' : 'btn-success');
                $this.text(result.active == '1' ? 'Deactive' : 'Active')
            })
        }
    };
</script>
<script>
    $(".buttonSearchUsername").on('click', TableMember.searchUser);
    $(".pagination").on('click', '.page-item:not(.disabled)', TableMember.getDataWithPage)
    $(".hover_show_info_user").on('mouseover', TableMember.showInfoUser);
    $(".hover_show_info_user").on('mouseleave', TableMember.hideInfoUser);
    $(".toggleActiveUser").on('click', TableMember.toggleActiveUser)
</script>