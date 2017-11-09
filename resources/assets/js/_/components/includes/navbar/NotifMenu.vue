<template>
    <div>
        <div class="search-container">
            <b-field grouped>
                <b-field expanded>
                    <b-field>
                        <b-input
                                size="is-small"
                                expanded
                        ></b-input>

                        <b-select
                                placeholder="Title"
                                size="is-small"
                        >
                            <option>Mr.</option>
                            <option>Ms.</option>
                        </b-select>
                    </b-field>
                </b-field>
            </b-field>
        </div>

        <ul>
            <li>asd</li>
            <li>asd</li>
            <li>asd</li>
            <li>asd</li>
            <li>asd</li>
        </ul>
    </div>
</template>
<script>
    export default {
        data: function (){
            return {
                search: ''
            };
        }
    }
</script>