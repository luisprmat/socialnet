<template>
    <div>
        <form @submit.prevent="submit" v-if="isAuthenticated">
            <div class="card-body bg-light">
                <textarea v-model="body"
                    class="form-control border-0 bg-light"
                    name="body"
                    :placeholder="`¿Qué estás pensando ${currentUser.name}?`"
                    required
                ></textarea>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary" id="create-status">
                    <i class="fas fa-paper-plane fa-fw"></i>
                    Publicar
                </button>
            </div>
        </form>
        <div v-else class="card-body">
            <a href="/login">Debes hacer login</a>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                body: '',
            }
        },
        methods: {
            submit() {
                axios.post('/statuses', {body: this.body})
                    .then(res => {
                        EventBus.$emit('status-created', res.data.data);
                        this.body = ''
                    })
                    .catch(err => {
                        console.log(err.response.data)
                    })
            }
        }
    }
</script>
