<template>
    <div class="contact-container dark-contact-container" :class="{'active-container':active}">
        <div class="contact-name">
            <h2>{{ text }}</h2>
        </div>
        <div class="contacts" @click.self="toggleActive()">
            <div v-if="contact1" class="contact" @click="copyContact(contact1)">
                <p class="contact-info">{{ contact1 }}</p>
            </div>
            <div v-if="contact2" class="contact" @click="copyContact(contact2)">
                <p class="contact-info">{{ contact2 }}</p>
            </div>
            <div v-if="contact3" class="contact" @click="copyContact(contact3)">
                <p class="contact-info">{{ contact3 }}</p>
            </div>
            <div v-if="contact4" class="contact" @click="copyContact(contact4)">
                <p class="contact-info">{{ contact4 }}</p>
            </div>
        </div>
    </div>    
</template>

<script>
export default {
    props:['name','contact1','contact2','contact3','contact4'],
    data() {
        return {
            active: false,
            text: null,
        }
    },
    methods: {
        toggleActive(){
            this.active = !this.active
        },
        copyContact(info){
            navigator.clipboard.writeText(info);
            this.setText("Copied!!")
            setTimeout(() => { this.assignTextToName()}, 1500);
        },
        assignTextToName(){
            this.setText(this.name);
        },
        setText(value){
            this.text = value
        }
    },
    mounted() {
        this.assignTextToName()
    },
}
</script>