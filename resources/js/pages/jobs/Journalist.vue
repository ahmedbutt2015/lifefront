<template>
    <section class="all-starups-area">
        <div class="container-fluid p-0" v-if="is_doer">

            <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                <li class="nav-item"><a class="nav-link active" id="work-tab" data-toggle="tab" href="#work" role="tab" aria-controls="work" aria-selected="true">My Work</a></li>
                <li class="nav-item"><a class="nav-link" id="accounts-tab" data-toggle="tab" href="#accounts" role="tab" aria-controls="accounts" aria-selected="true">Articals</a></li>
            </ul>


            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="work" role="tabpanel">

                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="job-icon">
                                <img :src="job.icon" :alt="job.job_name" class="img">
                            </div>
                            <h2 class="text-center">{{job.job_name}}</h2>
                            <p v-html="job.job_description"></p>


                            <div class="form-group form-row">
                                Subscription price <input type="number" v-model="owner.price" class="form-control text-center" style="max-width: 8rem;"> MO
                            </div>
                            <button class="genric-btn primary medium" @click="savePrice()">Save</button>
                        </div>
                    </div>


                    <div class="card mb-4">
                        <div class="card-body">
                            <h4>Add New Article</h4>

                            <form enctype="multipart/form-data" id="article-form">
                                <div class="form-group">
                                    <input type="text" name="title" class="form-control" placeholder="Title">
                                </div>

                                <div class="form-group">
                                    <textarea name="body" id="editor"></textarea>
                                </div>
                                <input type="hidden" name="character_id" v-model="owner.id">
                                <div class="form-group">
                                    <button type="button" @click="saveArticle()" class="genric-btn primary medium">Save</button>
                                </div>
                            </form>

                        </div>
                    </div>

                </div>
                <div class="tab-pane fade" id="accounts" role="tabpanel">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="job-icon">
                                <img :src="job.icon" :alt="job.job_name" class="img">
                                <h4 class="text-center">Articles</h4>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4" v-for="article in articles">
                        <h4 class="card-header">{{article.title}}</h4>
                        <div class="card-body" v-html="article.body"></div>
                    </div>
                </div>
            </div>


        </div>
        <div class="container-fluid p-0" v-else>

            <div class="card mb-4">
                <div class="card-body">
                    <div class="job-icon">
                        <img :src="job.icon" :alt="job.job_name" class="img">
                        <h4 class="text-center">Articles</h4>
                    </div>
                </div>
            </div>

            <div class="card mb-4" v-for="article in articles">
                <h4 class="card-header">{{article.title}}</h4>
                <div class="card-body" v-html="article.body"></div>
            </div>


        </div>
    </section>
</template>

<script>
    export default {
        name: "Journalist",
        data: () => ({
            is_doer: null,
            job: {
                job_name: '',
                job_description: '',
                icon: '',
            },
            owner: {},
            articles: [],
        }),
        async mounted() {
            if (this.$route.params.character === undefined) {
                this.is_doer = true;
                const {data} = await axios.post('/ajax/getJournalistJobDetails', {
                    job_id: this.$route.params.id,
                    ch_id: user.character.id
                });

                this.job = data.job;
                this.owner = data.owner;
                this.articles = data.articles;
                setTimeout(() => {
                    $('#editor').summernote();
                }, 1000)

            } else {
                this.is_doer = false;
                const {data} = await axios.post('/ajax/getJournalistJobDetails', {
                    job_id: this.$route.params.id,
                    ch_id: this.$route.params.character,
                });
                this.job = data.job;
                this.owner = data.owner;
                this.articles = data.articles;
            }
        },
        methods: {
            saveArticle() {

                let formData = new FormData($("#article-form")[0]);
                ;
                axios.post('/ajax/saveArticle', formData)
                    .then(res => {
                        let data = res.data;
                        this.articles = data.articles;
                        $("#article-form").resetForm();
                        alert("saved");
                    })
                    .catch(error => {
                        console.log(error);
                    })
            },
            savePrice() {
                let self = this;

                axios.post('/ajax/saveDeliveryCharges', {
                    id: self.owner.id,
                    price: self.owner.price,
                }).then(res => {
                    alert('saved')
                }).catch(error => {
                    console.log(error.response)
                })
            },
        }
    }
</script>

<style scoped>

</style>
