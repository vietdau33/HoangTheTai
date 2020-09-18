<?php
    $requests = $data['data'];
    unset($data['data']);
?>
<div class="container">
    <div class="row mt-3">
        <?php if($isUser) : ?>
            <div class="col-md-6 col-12 search-user">
                <input type="text" id="search_params_input" class="form-control d-inline-block w-75" value="<?=$search?>" title="<?=__('username_input')?>" placeholder="<?=__('username_input')?>">
                <button class="btn-custom ml-3 w-auto pl-3 pr-3 searchButton" style="padding: 3px 0"><?=__('search')?></button>
            </div>
        <?php else : ?>
            <div class="col-md-6 col-12 search-user">
                <div class="form-group position-relative reset-color">
                    <select id="chooise_type_select" class="form-control" style="width: 40%">
                        <option value="1" <?=($search['type'] ?? '') == '1' ? 'selected' : ''?>><?=__('search_username')?></option>
                        <option value="2" <?=($search['type'] ?? '') == '2' ? 'selected' : ''?>><?=__('search_user_request')?></option>
                    </select>
                    <div class="input_search" style="width: 40%">
                        <select id="chooise_user_request" class="form-control <?=($search['type'] ?? '1') == '1' ? 'd-none' : ''?> w-100">
                            <?php foreach ($userRequest as $user) : ?>
                                <option value="<?=$user['id']?>" <?=($search['search'] ?? '') == $user['username'] ? 'selected' : ''?>><?=$user['username']?></option>
                            <?php endforeach;?>
                        </select>
                        <input type="text" id="search_params_input" class="form-control <?=($search['type'] ?? '') == '2' ? 'd-none' : ''?> w-100" value="<?=$search['search'] ?? ''?>" title="<?=__('username_input')?>" placeholder="<?=__('username_input')?>">
                    </div>
                    <button class="btn-custom w-auto pl-3 pr-3 searchButton" style="padding: 3px 0"><?=__('search')?></button>
                </div>
            </div>
        <?php endif; ?>
        <div class="col-md-6 col-12">
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
                                <a class="page-link" href="#"><?=$i?></a>
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

        <div class="col-12 reset-color mt-3 table-request-history-full">
            <table class="table table-view-user bg-light text-center" border="1">
                <thead style="background: #5b9bd5">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">User Request</th>
                        <th scope="col">User Franchise</th>
                        <th scope="col">Franchise</th>
                        <th scope="col">Franchise date</th>
                        <th scope="col" colspan="2"><?=$isUser ? 'Status' : 'Action'?></th>
                    </tr>
                </thead>
                <tbody>
                <?php if(empty($requests)) : ?>
                    <tr>
                        <th colspan="6" class="bg-info">Not found franchise request!</th>
                    </tr>
                <?php endif; ?>
                <?php $count = 1; foreach ($requests as $request) : ?>
                    <tr data-id="<?=$request['id']?>" data-user='<?=json_encode($request['data-user'])?>'>
                        <th scope="row"><?=$count++?></th>
                        <td class="hover_show_info_user"><?=$request['user_enter']?></td>
                        <td><?=$request['user_request_name']?></td>
                        <td><?=$request['type_request']?></td>
                        <td><?=date('d-m-Y', strtotime($request['franchise_date']))?></td>
                        <td>
                            <?php if($isUser) : ?>
                                <button
                                    class="btn p-0
                                        <?=$request['active'] == '1' ? 'btn-success' : 'btn-warning'?>
                                        disabled not-allowed
                                    "
                                    style="padding: 2px 13px !important;"
                                    disabled
                                >
                                    <?=$request['active'] == '1' ? 'Actived' : 'Pending'?>
                                </button>
                            <?php else : ?>
                                <button
                                    class="btn p-0
                                        <?=$request['active'] == '1' ? 'btn-danger deactive' : 'btn-success active'?>
                                        toggleActiveRequest
                                    "
                                    style="color: #fff;padding: 2px 13px !important;"
                                >
                                    <?=$request['active'] == '1' ? 'Deactive' : 'Active'?>
                                </button>
                            <?php endif; ?>
                        </td>
                        <?php if(!$isUser) : ?>
                        <td>
                            <div class="removeRequest d-inline-block cursor-pointer">
                                <img src="<?=PUBLIC_URL?>images/icon/close.png" alt="Remove" style="width: 30px;">
                            </div>
                        </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <?php if($isUser) : ?>
            <div class="col-12 reset-color mt-3 table-request-history-mini" style="display: none">
                <table class="table table-view-user bg-light text-center" border="1">
                    <thead style="background: #5b9bd5">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col" colspan="2">User Franchise</th>
                            <th scope="col">Status</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if(empty($requests)) : ?>
                        <tr>
                            <th colspan="6" class="bg-info">Not found franchise request!</th>
                        </tr>
                    <?php endif; ?>
                    <?php $count = 1; foreach ($requests as $request) : ?>
                        <tr data-id="<?=$request['id']?>" data-user='<?=json_encode($request['data-user'])?>'>
                            <th scope="row"><?=$count++?></th>
                            <td class="hover_show_info_user" colspan="2"><?=$request['user_enter']?></td>
                            <td>
                                <button
                                    class="btn p-0
                                        <?=$request['active'] == '1' ? 'btn-success' : 'btn-warning'?>
                                        disabled not-allowed
                                    "
                                    style="padding: 2px 13px !important;"
                                    disabled
                                >
                                    <?=$request['active'] == '1' ? 'Actived' : 'Pending'?>
                                </button>
                            </td>
                            <td class="click_show_info_user" data-left='1'><i class="fa fa-sort-desc"></i></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>
<div class="table_info_user reset-color">
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

<?php if(!$isUser) : ?>
<script>
    $(document).ready(function(){
        $(".toggleActiveRequest").on('click', submitToggleActiveRequest);
        $(".removeRequest").on('click', removeRequest);
        $("#chooise_type_select").on('change', changeTypeSearch)
    })
</script>
<script>
    function submitToggleActiveRequest(){
        var el = this;
        if($(this).hasClass('deactive')){
            alertify.confirm('<?=__('are_you_sure_deactive_this_request')?>', function(){
                toggleActiveRequest(el);
            }).set({'title' : 'Confirm'})
        }else{
            toggleActiveRequest(el);
        }
    }
    function toggleActiveRequest(el){
        var self = el;
        var $tr = $(self).closest('tr');
        var id = $tr.attr('data-id');
        _ajax(base_url + '/franchise_request/toggleActiveRequest', {id : id}, function(result){
            if(result.code == 200){
                $(self).text(result.text)
                if(result.btn == 'success'){
                    $(self).removeClass('btn-danger').removeClass('deactive').addClass('btn-success')
                }else if(result.btn == 'danger'){
                    $(self).removeClass('btn-success').addClass('btn-danger').addClass('deactive');
                }
                return true;
            }
            alertify.alert(result.message).set({'title' : 'Notification'});
            return true;
        })
    }
    function removeRequest(){
        var self = this;
        var $tr = $(self).closest('tr');
        var id = $tr.attr('data-id');
        alertify.confirm('Are you sure delete this request?', function(){
            _ajax(base_url + '/franchise_request/deleteRequest', {id : id}, function(result){
                if(result.code == 200){
                    alertify.success(result.message);
                    $(".menu-page[page=request_submit_history]").click();
                }else{
                    alertify.error(result.message);
                }
            })
        }).set({'title' : 'Confirm'});
    }
    function changeTypeSearch(){
        var val = $(this).val();
        if(val == '1'){
            $("#chooise_user_request").addClass('d-none');
            $("#search_params_input").removeClass('d-none').val('');
        }else{
            $("#chooise_user_request").removeClass('d-none').val('2');
            $("#search_params_input").addClass('d-none');
        }
    }
</script>
<?php endif; ?>
<script>
    function search(page){
        if(typeof page == 'undefined'){
            page = '<?=$data['pageNow']?>';
        }
        <?php if($isUser) :?>
            var search = $("#search_params_input").val().trim();
            if(search == '' && typeof page == 'undefined'){
                alertify.error('<?=__('please_enter_username_before_search')?>');
                return false;
            }
        <?php else : ?>
            var type = $("#chooise_type_select").val();
            var search = '';
            if(type == '1'){
                search = $("#search_params_input").val().trim();
                if(search == '' && typeof page == 'undefined'){
                    alertify.error('<?=__('please_enter_username_before_search')?>');
                    return false;
                }
            }else if(type == '2'){
                search = $("#chooise_user_request").val();
            }
            search = {
                type : type,
                search : search
            }
        <?php endif; ?>
        getHtml('request_submit_history', page, search);
    }
    function getDataWithPage(e){
        e.preventDefault();
        e.stopPropagation();
        var page = $(this).attr('page');
        search(page)
    }
    function _search(){
        search();
    }
    function showInfoUser(e){
        if($(e.target).hasClass('edit_password_element') || $(e.target).closest('.edit_password_element').length > 0){
            return hideInfoUser();
        }
        var $this = $(e.target).closest('tr');
        var $td = $(e.target).closest('td');
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

        var left = e.clientX + 10;
        if($td.attr('data-left') == '1'){
            left = e.clientX + 25 - $(".table_info_user").innerWidth() - $td.innerWidth();
        }

        var objCss = {
            'left' : left + 'px'
        };


        if(window.screen.height - 500 < e.clientY){
            objCss['transform'] = 'translateY(-100%)';
            objCss['top'] = $this.offset().top - $(window).scrollTop() + 'px';
        }else{
            objCss['top'] = $this.offset().top - $(window).scrollTop() + $this.height() + 'px';
        }

        $(".table_info_user").removeAttr('style').css(objCss);
    }
    function hideInfoUser() {
        $(".table_info_user").removeAttr('style').css({
            'top' : '-500px',
            'left' : '-500px'
        });
        return false;
    }
</script>
<script>
    var tableMini = $(".table-request-history-mini");
    if(window.screen.width <= 767 && tableMini.length > 0){
        tableMini.show();
        $(".table-request-history-full").hide();
    }
    $(".searchButton").on('click', _search)
    $(".pagination").on('click', '.page-item:not(.disabled)', getDataWithPage)
    $(".hover_show_info_user").on('mouseover', showInfoUser);
    $(".hover_show_info_user").on('mouseleave', hideInfoUser);
    $(".click_show_info_user").on('mouseover', showInfoUser);
    $(document).on('click', function(e){
        if(
            $(e.target).closest(".click_show_info_user").length == 0
            && $(e.target).closest(".table_info_user").length == 0
            && $(e.target).closest(".hover_show_info_user").length == 0
        ){
            hideInfoUser();
        }
    })
</script>
