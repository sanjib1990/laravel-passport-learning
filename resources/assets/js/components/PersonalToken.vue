<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Create your Personal Token
                    </div>
                    <div class="panel-body">
                        <div class="alert alert-danger" v-if="errors.length > 0">
                            <ul>
                                <li v-for="error in errors">{{ error }}</li>
                            </ul>
                        </div>

                        <div class="form-group">
                            <label for="token_name">Token Name:</label>
                            <input type="text" name="token_name" id="token_name" placeholder="Token Name"
                                   class="form-control"
                                   v-model="token.token_name">
                        </div>
                        <div class="form-group">
                            <label for="scopes">Scopes:</label>
                            <textarea name="scopes" id="scopes" cols="30" rows="5" class="form-control"
                                      placeholder="Token Scopes: comma separated scopes"
                                      v-model="token.scopes"></textarea>
                        </div>
                        <button class="btn btn-danger btn-xs" @click="createToken(index)">Create Token</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                token: {},
                errors: []
            }
        },
        mounted()
        {
        },
        methods: {
            initAddTask()
            {
                this.errors = [];
            },
            createToken()
            {
                axios.post('/personal/token', this.token).then(response => {
                    console.log(response);
                }).catch(error => {
                    this.errors = [];
                    if (error.response.data.errors.name) {
                        this.errors.push(error.response.data.errors.name[0]);
                    }

                    if (error.response.data.errors.description) {
                        this.errors.push(error.response.data.errors.description[0]);
                    }
                });
            }
        }
    }
</script>