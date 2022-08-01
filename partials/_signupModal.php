
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signupModalLabel">Sign Up</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/forum/partials/_signupHandler.php" method="post">
                    
                        <div class="mb-3">
                            <label for="signupemail" class="form-label">Email address</label>
                            <input name="signupemail" type="email" class="form-control" id="signupemail" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="uname" class="form-label">Username</label>
                            <input name="uname" type="text" class="form-control" id="uname">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password"
                            id="password">
                        </div>
                        <div class="mb-3">
                            <label for="cpassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" name="cpassword"
                            id="cpassword">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-outline-success">Signup</button>
                        </div>
                    </div>
                </form>
        </div>
    </div>
</div>
