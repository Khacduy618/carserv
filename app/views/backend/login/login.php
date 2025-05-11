<div class="auth-main">
    <div class="auth-wrapper v3">
        <div class="auth-form">
            <div class="card my-5">
                <div class="card-body">
                    <form action="<?php echo _WEB_ROOT; ?>/dang-nhap-admin" method="POST">
                        <div class="d-flex justify-content-center align-items-end mb-4">
                            <h3 class="text-center"><b>Admin</b></h3>
                            <!-- <a href="#" class="link-primary">Don't have an account?</a> -->
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Tên đăng nhập</label>
                            <input type="text" class="form-control" name="Username" placeholder="Tên đăng nhập">
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Mật khẩu</label>
                            <input type="password" class="form-control" name="Password" placeholder="Mật khẩu">
                        </div>
                        <div class="d-flex mt-1 justify-content-between">
                            <!-- <div class="form-check">
                                <input class="form-check-input input-primary" type="checkbox" id="customCheckc1"
                                    checked="">
                                <label class="form-check-label text-muted" for="customCheckc1">Keep me sign in</label>
                            </div> -->
                            <!-- <h5 class="text-secondary f-w-400">Forgot Password?</h5> -->
                        </div>
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary">Đăng nhập</button>
                        </div>
                    </form>
                    <div class="saprator mt-3">
                        <span>Login with</span>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="d-grid">
                                <button type="button" class="btn mt-2 btn-light-primary bg-light text-muted">
                                    <img src="<?php echo _WEB_ROOT; ?>/public/assets/admin/images/authentication/google.svg"
                                        alt="img"> <span class="d-none d-sm-inline-block"> Google</span>
                                </button>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="d-grid">
                                <button type="button" class="btn mt-2 btn-light-primary bg-light text-muted">
                                    <img src="<?php echo _WEB_ROOT; ?>/public/assets/admin/images/authentication/twitter.svg"
                                        alt="img"> <span class="d-none d-sm-inline-block"> Twitter</span>
                                </button>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="d-grid">
                                <button type="button" class="btn mt-2 btn-light-primary bg-light text-muted">
                                    <img src="<?php echo _WEB_ROOT; ?>/public/assets/admin/images/authentication/facebook.svg"
                                        alt="img"> <span class="d-none d-sm-inline-block"> Facebook</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>