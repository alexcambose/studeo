<template>
    <b-field>
        <b-input placeholder="Caută intrebări"
                 type="search"
                 icon="magnify"
        >
        </b-input>
    </b-field>
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