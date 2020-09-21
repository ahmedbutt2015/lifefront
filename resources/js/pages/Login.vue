<template>
    <form class="form" id="login-from" method="post">
        <div @click="error_list=null" class="alert alert-danger" v-if="error_list != null">
            <p v-for="error in error_list" v-html="error[0]"></p>
        </div>
        <h3>Log In</h3>
        <div class="form-holder">
            <span class="lnr lnr-envelope"></span>
            <input type="text" name="email" class="form-control" placeholder="Mail" required>
        </div>
        <div class="form-holder">
            <span class="lnr lnr-lock"></span>
            <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>
        <button type="button" @click="login">Login</button>
        <br>
        <div><a href="/login/facebook" class=""><i class="fa fa-facebook"></i> Login with Facebook</a></div>
        <div><a href="/login/google"><i></i> Login with Google</a></div>
        <br>
        Do not have an account?
        <router-link style="color:#222222" to="/register"> Register</router-link>
    </form>
</template>

<script>
    export default {
        data: () => ({
            error_list: null
        }),
        methods: {
            login() {
                let form = $('#login-from');
                let data = form.serialize();
                let url = '';
                let obg = this
                axios.post(url, data)
                    .then(function (response) {
                        window.location = '/';
                    })
                    .catch(function (error) {
                        let data = error.response.data
                        console.log(data)
                        obg.error_list = data.errors
                        // alert(data.message);
                    });

            }
        }
    }
</script>
