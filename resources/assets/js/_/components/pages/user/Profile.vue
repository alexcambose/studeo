<template>
    <div class="profilPage">
        <div class="banner" :style="{backgroundColor: bannerColor}"></div>
        <div class="profileNav">
            <div class="container">
                <div class="profileImage" style="background: url('http://3.bp.blogspot.com/_d70o0QbCQYg/ShA41KQQn1I/AAAAAAAABf8/-tffws7CMjc/s400/Internet_man+slave+of+computer+3.bmp')"></div>
                <div class="avatarImage"></div>
            </div>
        </div>
        <div class="mainUser container">
            <div class="columns">
                <div class="column is-one-quarter">
                    <div class="userDetails">
                        <h3 class="fullname">{{ fullname(user.first_name, user.last_name) }}</h3>
                        <router-link :to="{ name: 'profile', params: {username: user.username}}">&nbsp; @{{ user.username }}</router-link>
                        <div class="shortDescription">
                            &nbsp; {{ user.description }}
                        </div>
                        <div class="oras" v-if="user.city">
                            <i class="fa fa-building fa-lg"></i>
                            {{ user.city }}
                        </div>
                        <div class="dataNastere" v-if="user.birth_date">
                            <p>
                                <i class="fa fa-birthday-cake fa-lg"></i>
                            Născut la {{ displayDate(user.birth_date) }}
                            </p>
                        </div>
                        <div class="scoala">
                            <i class="fa fa-graduation-cap fa-lg"></i>
                            {{ user.school }}
                        </div>
                        <div class="dataAlaturare">
                            <i class="fa fa-calendar-check-o fa-lg"></i>
                            S-a alăturat în {{ displayDate(user.created_at) }}
                        </div>
                    </div>
                </div>
                <div class="column">b</div>
                <div class="column is-one-quarter">c</div>
            </div>
        </div>

    </div>
</template>
<script>
    export default { //n-am vazut nimic :>
        computed: {
            bannerColor() {
                return this.$store.state.user.user.cover_color;
            },
            user() {
                return this.$store.state.user.user;
            }
        },
        methods: {
            fullname(firstname, lastname) {
                var fullname = firstname + ' ' + lastname;
                return fullname
            },

            displayDate(date) {
                var shortDate = date.slice(0, 10);
                return shortDate;
            }
        }
    }
</script>