<?php
    $requests = $data['data'];
    unset($data['data']);
?>
<div class="container">
    <div class="row mt-3">
        <?php if($isUser) : ?>
            <div class="col-6 search-user">
                <input type="text" id="search_params_input" class="form-control d-inline-block w-75" value="<?=$search?>" title="<?=__('username_input')?>" placeholder="<?=__('username_input')?>">
                <button class="btn-custom ml-3 w-auto pl-3 pr-3 searchButton" style="padding: 3px 0"><?=__('search')?></button>
            </div>
        <?php else : ?>
            <div class="col-6 search-user">
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

        <div class="col-12 reset-color mt-2">
            <table id="table_upgrade_request" class="table table-striped table-view-user bg-light text-center" border="1">
                <thead style="background: #5b9bd5">
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">User Request</th>
                    <th scope="col">User Franchise</th>
                    <th scope="col">Franchise</th>
                    <th scope="col">Date request</th>
                    <th scope="col"><?=$isUser ? 'Status' : 'Action'?></th>
                </tr>
                </thead>
                <tbody>
                <?php if(empty($requests)) : ?>
                    <tr>
                        <th colspan="6" class="bg-info">Not found upgrade request!</th>
                    </tr>
                <?php endif; ?>
                <?php $count = 1; foreach ($requests as $request) : ?>
                    <tr data-id="<?=$request['id']?>">
                        <th scope="row"><?=$count++?></th>
                        <td><?=$request['user_enter']?></td>
                        <td><?=$request['user_request']?></td>
                        <td><?=ucfirst($request['type_request'])?></td>
                        <td><?=date('d-m-Y', strtotime($request['date_request']))?></td>
                        <td>
                            <?php if($isUser) : ?>
                                <button class="btn not-allowed disabled <?=$request['approved'] == '1' ? 'btn-success' : 'btn-warning'?> p-0" disabled style="color: #fff;padding: 2px 13px !important;">
                                    <?=$request['approved'] == '0' ? 'Pending' : 'Approved'?>
                                </button>
                            <?php else : ?>
                                <button class="btn <?=$request['approved'] == '1' ? 'btn-primary approved disabled' : 'btn-success'?> p-0 approveRequest" <?=$request['approved'] == '1' ? 'disabled' : ''?> style="color: #fff;padding: 2px 13px !important;">
                                    <?=$request['approved'] == '0' ? 'Approve' : 'Approved'?>
                                </button>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php if(!$isUser) : ?>
<script>
    $(document).ready(function(){
        $("#table_upgrade_request").on('click', '.approveRequest:not(.approved)', approveRequest);
        $("#chooise_type_select").on('change', changeTypeSearch)
    })
</script>
<script>
    function approveRequest(){
        var self = this;
        var $tr = $(self).closest('tr');
        var id = $tr.attr('data-id');
        _ajax(base_url + '/upgrade_request/approveRequest', {id : id}, function(result){
            if(result.code == 200){
                $(self)
                    .text(result.text)
                    .removeClass('btn-success')
                    .addClass('btn-primary')
                    .addClass('disabled')
                    .attr('disabled', true)
                    .addClass('approved');
                return true;
            }
            alertify.alert(result.message).set({'title' : 'Notification'});
            return true;
        })
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
        getHtml('upgrade_request', page, search);
    }
    function getDataWithPage(e){
        e.preventDefault();
        e.stopPropagation();
        var page = $(this).attr('page');
        getHtml('upgrade_request', page);
    }
    function _search(){
        search();
    }
</script>
<script>
    $(".searchButton").on('click', _search)
    $(".pagination").on('click', '.page-item:not(.disabled)', getDataWithPage)
</script>
