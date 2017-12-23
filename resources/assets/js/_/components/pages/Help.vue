<template>
    <div class="container content-lower">
        <div class="columns">
            <div class="column is-6 is-offset-3">
                <b-field>
                    <b-input placeholder="Caută intrebări"
                             type="search"
                             icon="magnify"
                    >
                    </b-input>
                </b-field>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                questions: [
                    {
                        title: 'Question #1',
                        content: 'Answer',
                    },
                ],
            };
        },
    };
</script>