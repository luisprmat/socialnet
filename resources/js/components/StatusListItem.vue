<template>
    <div class="card mb-3 border-0 shadow-sm">
        <div class="card-body d-flex flex-column">
            <div class="d-flex align-items-center mb-3">
                <img class="rounded mr-3 shadow-sm" width="40px" src="/images/default-user.png" alt="user">
                <div>
                    <h5 class="mb-1" v-text="status.user_name"></h5>
                    <div class="small text-muted" v-text="status.ago"></div>
                </div>
            </div>
            <p class="card-text text-secondary" v-text="status.body"></p>
        </div>
        <div class="card-footer p-2 d-flex justify-content-between align-items-center">

            <like-btn
                :status="status"
            ></like-btn>

            <div class="text-secondary mr-2">
                <i class="far fa-thumbs-up fa-fw"></i>
                <span dusk="likes-count">{{ status.likes_count }}</span>
            </div>
        </div>
    </div>
</template>

<script>
    import LikeBtn from './LikeBtn';

    export default {
        props: {
            status: {
                type: Object,
                required: true
            }
        },
        components: { LikeBtn }
    }
</script>
