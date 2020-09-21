<template>
    <section>
        <section class="all-starups-area">

            <div class="card">
                <div class="card-body" style="min-height: 50vh;">
                    <hr>
                    <div class="row">
                    <div class="side">
                            <h4>Contacts</h4>
                            <hr>
                            <model-select class="mb-4" :options="contacts" v-model="chat_to" placeholder="Select Contact"
                            ></model-select>
                            <button class="genric-btn primary small circle" @click="getChat()">Start Chat</button>
                         <hr>
                        <h4>Message</h4>
                            <ul>
                            <li class="genric-btn medium btn-block primary"
                             v-for="item in check" :key="item.id"  @click="getChat2(item)">
                                {{ item.first_name + " "+ item.last_name }}
                            </li>
                            </ul>
                                </div>
                                <div class="main">
                        <div  v-if="chat_name">
                            <h2>{{chat_name}}</h2>
                            <div v-for="msg in texts" class="form-row chat">
                                <div class="col text-left">
                                    <div v-if="!isOwner(msg.from)" :class="{'chat-to': !isOwner(msg.from)}">
                                        {{msg.message}}
                                    </div>
                                </div>
                                <div class="col text-right">
                                    <div v-if="isOwner(msg.from)" :class="{'chat-from' : isOwner(msg.from)}">
                                        {{msg.message}}
                                    </div>
                                </div>
                            </div>
                            <div v-if="chat_to">
                                <hr>
                                <div class="form-row">
                                    <div class="col"><input type="text" class="form-control" v-model="send_msg"></div>
                                    <div class="col-2">
                                        <button class="genric-btn medium btn-block primary" @click="send()">Send</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                            </div>
                            </div>
                </div>
            </div>

        </section>
    </section>
</template>

<script>
    export default {
        props: {},
        data: () => ({
            contacts: [],
            chat_name: '',
            chat_message_name:'',
            texts: [],
            checkChat:[],
            check:[],
            showMessage:true,
            chat_to: {
                value: '',
                text: '',
            },
            send_msg: '',
        }),

        async mounted() {
            const {data} = await axios.post('/ajax/getContacts');
            this.contacts = data
            console.log("this.contacts",this.contacts);
            this.getdetailall();

        },

        methods: {
          getdetailall() {
                     console.log('calledaa',user.character.id);

                    axios.post('/ajax/getChatDetailsalready', {
                        id: user.character.id,
                    })
                        .then(res => {
                            this.check = res.data;

                            console.log("check",this.check);
                        })
                        .catch(error => {
                            console.log(error.response)
                        })
                    },
             getMessageall(item) {
                   this.showMessage = true;
                    axios.post('/ajax/getMesssageDetails', {
                        ch: item.id,
                        id: user.character.id
                    })
                        .then(res => {
                            this.checkChat = res.data;
                            console.log("this.checkChat",this.checkChat);
                        })
                        .catch(error => {
                            console.log(error.response)
                        })
            },
            getChat2(item) {
                   this.showMessage = false;
                this.chat_name = item.first_name+' '+item.last_name,
                this.chat_to.value = item.id, 
                    axios.post('/ajax/getChatDetails', {
                        id: item.id,
                        ch: user.character.id,
                    })
                        .then(res => {
                            this.texts = res.data;
                        })
                        .catch(error => {
                            console.log(error.response)
                        })
            },
            getChat() {
                   this.showMessage = false;
                this.chat_name = this.chat_to.text,
                console.log("this.chat_to.text",this.chat_to.text);
                    axios.post('/ajax/getChatDetails', {
                        id: this.chat_to.value,
                        ch: user.character.id,
                    })
                        .then(res => {
                            this.texts = res.data;
                        })
                        .catch(error => {
                            console.log(error.response)
                        })
            },
            isOwner(id) {
                return id == user.character.id ? true : false
            },
            send() {
                axios.post('/ajax/sendMessage', {
                    to: this.chat_to.value,
                    from: user.character.id,
                    message: this.send_msg,
                })
                    .then(res => {
                        this.texts = res.data;
                        this.send_msg = '';
                    })
                    .catch(error => {
                        console.log(error.response)
                    })
            }
        }
    }
</script>

<style scoped>
    .contacts {
        background: #FDFDFD;
    }

    .chat {
        max-height: 70vh;
        overflow-y: paged-y-controls;
    }

    .chat-from {
        color:         #FFFFFF;
        background:    #1F2B7B;
        padding:       5px 10px;
        border-radius: 5px;
        width:         auto;
        margin-bottom: 3px;
    }

    .chat-to {
        color:         #FFFFFF;
        background:    #3C4858;
        padding:       5px 10px;
        border-radius: 5px;
        width:         auto;
        margin-bottom: 3px;
    }
    .row {  
  display: flex;
  flex-wrap: wrap;
}

/* Create two unequal columns that sits next to each other */
/* Sidebar/left column */
.side {
  flex: 17%;
  background-color: #f1f1f1;
  padding: 20px;
}

/* Main column */
.main {
    max-height: 431px;
    overflow-y: scroll;
  flex: 70%;
  background-color: white;
  padding: 20px;
}
</style>
