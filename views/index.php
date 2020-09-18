<?php
    $userInfo = (new MemberController())->getInfo();
    $aryCreateStartup = ['startup', 'entrepreneur', 'enterprise'];
    $aryCreateEntrepreneur = ['entrepreneur', 'enterprise'];
    $aryCreateEnterprise = ['enterprise'];
    $countries = (new ContryModels())->all();
?>


<div class="container">
    <div class="row mt-5">
        <div class="col-6">
            <div class="bg_box_info">
                <div class="bonus_fees">
                    <?php if($userInfo['franchise_type'] == 'enterprise') : ?>
                        <span>SUPPORT FEES: <span class="highlight <?=$userInfo['franchise_type']?>"><?=$userInfo['support_fees']?> $</span></span>
                    <?php endif; ?>
                </div>
                <div class="box-info">
                    <div class="edit-info" data-id="<?=$userInfo['id']?>"><div class="fa fa-edit"></div></div>
                    <div class="row p-0">
                        <div class="col-5">
                            <div class="text-center">
                                <div class="avatar">
                                    <img src="<?=PUBLIC_URL?>images/user.png" alt="User avatar">
                                </div>
                            </div>
                        </div>
                        <div class="col-7">
                            <ul style="list-style: none">
                                <li><img src="<?=PUBLIC_URL . $userInfo['flag']?>" alt="" style="width: 40px"></li>
                                <li><b>ID: <?=$userInfo['username']?></b></li>
                                <li>Fullname: <?=$userInfo['fullname']?></li>
                                <li>Email: <?=$userInfo['email']?></li>
                                <li>Phone: <?=$userInfo['phone']?></li>
                                <li><a href="" style="color: #fff; text-decoration: underline;" class="editPassword"><?=__('change_password')?></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-5">
                            <div class="express pl-4 pr-4">
                                <div class="font-weight-bold"><?=__('level')?>: <span class="highlight <?=$userInfo['franchise_type']?>"><?=$userInfo['franchise']?></span></div>
                                <?=__('license')?>: <?=$userInfo['license']?>
                            </div>
                        </div>
                        <div class="col-7">
                            <div><?=__('renewal_date')?>: <?=$userInfo['franchise_date']?></div>
                            <div><?=__('license_remaining')?>: <?=$userInfo['license_remaining']?></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-center">
                            <button class="button-custom buy_license mt-3"><?=$userInfo['franchise_type'] == 'enterprise' ? 'Buy license' : 'Upgrade'?></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="bg_box_create_user">
                <div class="bonus_income">
                    <span>INCOME FRANCHISE: <span class="highlight <?=$userInfo['franchise_type']?>"><?=$userInfo['income_franchise']?> $</span></span>
                </div>
                <div class="box-info">
                    <div class="row hr-line">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="username_copy_trading">Username Copy Trading</label>
                                <input type="text" class="input-custom" id="username_copy_trading" name="username">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="input-custom" id="password" name="password">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="fullname">Fullname</label>
                                <input type="text" class="input-custom" id="fullname" name="fullname">
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="input-custom" id="phone" name="phone">
                            </div>
                            <div class="form-group">
                                <label for="franchise">Choose Franchise</label>
                                <select name="franchise" id="franchise" class="input-custom">
                                    <?php if(in_array($userInfo['franchise_type'], $aryCreateStartup)) : ?>
                                        <option value="2">START-UP</option>
                                    <?php endif; ?>
                                    <?php if(in_array($userInfo['franchise_type'], $aryCreateEntrepreneur)) : ?>
                                        <option value="3">ENTERPRENEUR</option>
                                    <?php endif; ?>
                                    <?php if(in_array($userInfo['franchise_type'], $aryCreateEnterprise)) : ?>
                                        <option value="4">ENTERPRISE</option>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="input-custom" id="email" name="email">
                            </div>
                            <div class="form-group">
                                <label for="contry">Country</label>
                                <div class="contry_select">
                                    <select name="contry" id="contry" class="input-custom">
                                        <option value="--dd">Choose Country</option>
                                        <?php foreach ($countries as $country) : ?>
                                            <option value="<?=$country['id']?>" data-flag="<?=PUBLIC_URL . $country['flag']?>">
                                                <?= trim(explode('(', $country['name'])[0] ?? '') ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="button-custom create_user w-100" style="margin-top: 26px;">Create</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-6 position-relative comparing_table">
            <img src="<?=PUBLIC_URL?>images/comparing_table.png" alt="">
        </div>
        <div class="col-6">
            <div class="bg_box_send_request">
                <div class="bonus_income_mib">
                    <span>INCOME MIB: <span class="highlight <?=$userInfo['franchise_type']?>"><?=$userInfo['income_mib']?> $</span></span>
                </div>
                <div class="box-info">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="username_franchise_request">Username Copy Trading</label>
                                <input type="text" class="input-custom text-center" id="username_franchise_request" placeholder="<?=__('enter_username')?>">
                            </div>
                            <select id="type_franchise_request" class="d-none">
                                <option value="1" selected>MIB 0.6</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <button class="button-custom submit_create_franchise_request w-100" style="margin-top: 26px;">Request mib 0.6</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="logo_bottom">
    <img src="<?=PUBLIC_URL?>images/logo_bottom_user.png" alt="">
</div>

<div class="modal fade" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="changePassworLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?=__('change_password')?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="username_change" class="col-form-label"><?=__('username')?></label>
                    <input type="text" class="form-control" id="username_change" disabled>
                </div>
                <div class="form-group">
                    <label for="password_change" class="col-form-label"><?=__('new_password')?></label>
                    <input type="text" class="form-control" id="password_change" autocomplete="off">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?=__('close')?></button>
                <button type="button" class="btn btn-primary saveChangePassword"><?=__('save')?></button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="buyLicense" tabindex="-1" role="dialog" aria-labelledby="buyLicense" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">CHOOSE FRANCHISE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php if($userInfo['franchise_type'] != 'enterprise') : ?>
                    <div class="form-group">
                        <label for="username_view" class="col-form-label"><?=__('username')?></label>
                        <input type="text" class="form-control" id="username_view" disabled>
                    </div>
                    <div class="form-group">
                        <label for="password_change" class="col-form-label">Choose Franchise</label>
                        <select name="franchise_type" id="franchise_type" class="input-custom" style="border: 1px solid rgba(0,0,0,0.4)">
                            <option value="startup">START-UP</option>
                            <option value="entrepreneur">ENTERPRENEUR</option>
                            <option value="enterprise">ENTERPRISE</option>
                        </select>
                    </div>
                <?php else : ?>
                    <div class="form-group">
                        <label for="username_view" class="col-form-label"><?=__('username')?></label>
                        <input type="text" class="form-control" id="username_view" disabled>
                    </div>
                    <div class="form-group">
                        <label for="password_change" class="col-form-label">Choose Amount</label>
                        <select name="franchise_type" id="franchise_type" class="input-custom" style="border: 1px solid rgba(0,0,0,0.4)">
                            <option value="1" selected>60 Licenses</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="username_view" class="col-form-label">Total</label>
                        <input type="text" class="form-control" value="$18.000" disabled>
                    </div>
                <?php endif; ?>
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <button class="button-custom upgrade w-100" style="margin-top: 26px;"><?=$userInfo['franchise_type'] != 'enterprise' ? 'UPGRADE' : 'BUY'?></button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $(".editPassword").on('click', function(e){
            e.preventDefault();
            var username = '<?=$userInfo['username']?>';
            $("#changePassword").find("#username_change").val(username);
            $("#changePassword").modal('show');
        })
        $(".buy_license").on('click', function(e){
            e.preventDefault();
            var username = '<?=$userInfo['username']?>';
            $("#buyLicense").find("#username_view").val(username);
            $("#buyLicense").modal('show');
        })
        $(".saveChangePassword").on('click', function () {
            var $modal = $("#changePassword");
            var password = $modal.find('#password_change').val().trim();
            if(password == ''){
                alertify.error('<?=__('password_empty')?>');
                return false;
            }
            _ajax(base_url + '/member/change_password', {
                password : password
            }, function(result){
                if(result.code == 200){
                    alertify.success(result.message);
                    $modal.find('#password_change').val('');
                    $modal.modal('hide');
                }else{
                    alertify.error(result.message);
                }
            })
        })
        $(".submit_create_franchise_request").on('click', function(e){
            e.preventDefault();
            var user_enter = $("#username_franchise_request").val().trim();
            var type_request = $("#type_franchise_request").val();
            if(user_enter == '' || type_request == 0){
                alertify.error('<?=__('please_enter_username_and_chooise_franchise')?>');
                return false;
            }
            var params = {
                user_enter : user_enter,
                type_request : type_request
            };
            alertify.confirm('<?=__('are_you_sure_create_franchise_request')?>', function(){
                _ajax(base_url + '/franchise_request/createFranchiseRequest', params, function(result){
                    if(result.code == 200){
                        alertify.success(result.message);
                        $("#type_franchise_request").val('0');
                        $("#username_franchise_request").val('');
                        return true;
                    }
                    alertify.error(result.message);
                })
            }).set({'title' : '<?=__('confirm')?>'})
        })
        $(".upgrade").on('click', function(){
            var type = $(this).closest('.modal').find("#franchise_type").val();
            alertify.confirm('<?=$userInfo['franchise_type'] != 'enterprise' ? __('are_you_sure_upgrade') : 'Buy license?'?>', function(){
                _ajax(base_url + '/member/upgrade', {type : type}, function(result){
                    if(result.code == 200){
                        alertify.success(result.message)
                    }else{
                        alertify.error(result.message)
                    }
                }, function(){
                    $("#buyLicense").modal('hide');
                })
            }).set({'title' : 'Confirm'});
        })
        $("#contry").on('change', function(e){
            $("#contry").find('option[value=--dd]').remove();
            var flag = $(this).find('option[value=' + $(this).val() + ']').attr('data-flag');
            if($("#contry").parent().find('img').length > 0){
                $("#contry").parent().find('img').attr('src', flag);
                return true;
            }
            $("#contry").after('<img src="' + flag + '">');
        })
        $("#phone").on('keydown', function(e){
            var keyCode = e.which || e.keyCode;
            var aryAllow = [8, 37, 38, 39, 40, 17, 27, 18, 46, 16, 187];
            return !!((keyCode >= 48 && keyCode <= 57) || ($.inArray(keyCode, aryAllow) != -1));
        })
        $(".create_user").on('click', function(){
            var params = getDataFormCreateUser();
            if(Object.size(params) == 0){
                return false;
            }
            params['username'] = params['username_copy_trading'];
            var messageConfirm = 'Create user?';
            var reload = false;
            if($(this).hasClass('update_user')){
                params['is_update'] = '1';
                messageConfirm = 'Update info?';
                reload = true;
            }
            alertify.confirm(messageConfirm, function(){
                _ajax(base_url + '/member/create_user', params, function(result){
                    if(result.code == 200){
                        $("#table_member").empty().append(result.html);
                        alertify.success(result.message);
                        if(reload){
                            window.location.reload();
                        }
                    }else{
                        alertify.error(result.message);
                    }
                    resetFormCreateUser();
                    return false;
                })
            }).set({'title' : 'Confirm'});
        })
        $(".edit-info").on('click', function(){
            _ajax(base_url + '/member/getUserEdit', {}, function(result){
                if(result.code != 200){
                    alertify.error(result.message);
                    return false;
                }
                result = result.data;
                $("#username_copy_trading").val(result.username).attr('disabled', true);
                $("#password").val(result.password).attr('disabled', true);
                $("#fullname").val(result.fullname);
                $("#email").val(result.email);
                $("#phone").val(result.phone);
                $("#contry").val(result.contry);
                $("#franchise").val(result.franchise).attr('disabled', true);
                $(".create_user").text('UPDATE').addClass('update_user');
            })
        })
    })
    function getDataFormCreateUser(){
        var aryID = ['username_copy_trading', 'password', 'fullname', 'phone', 'franchise', 'email', 'contry'];
        var error = false;
        var params = {};
        for(let i in aryID){
            var item = $("#" + aryID[i]);
            var thisValue = item.val().trim();
            if(thisValue == ''){
                error = true;
                item.addClass('error_data');
                item.one('focus', function(){
                    $(this).removeClass('error_data');
                })
            }
            if(!error){
                switch (aryID[i]) {
                    case 'email' :
                        if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(thisValue))){
                            error = true;
                            item.addClass('error_data');
                            item.one('focus', function(){
                                $(this).removeClass('error_data');
                            })
                        }
                        break;
                    case 'contry' :
                        if(thisValue == '--dd'){
                            error = true;
                            item.addClass('error_data');
                            item.one('focus', function(){
                                $(this).removeClass('error_data');
                            })
                        }
                        break;
                }
            }
            if(!error){
                params[aryID[i]] = thisValue;
            }
        }
        return error ? {} : params;
    }
    function resetFormCreateUser(){
        var aryID = ['username_copy_trading', 'password', 'fullname', 'phone', 'email'];
        for(let i in aryID) {
            $("#" + aryID[i]).val('');
        }
        var valueFirstFranchise = $("#franchise").find('option:first-child').attr('value');
        $("#franchise").val(valueFirstFranchise);
        $(".contry_select").find('img').remove();
        $("#contry").prepend('<option value="--dd">Choice County</option>').val('--dd');
        $(".create_user").text('CREATE').removeClass('update_user');
        $("#franchise, #password, #username_copy_trading").removeAttr('disabled');
    }
</script>