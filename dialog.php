
<div @click="pop = null" id="overlay" x-cloak x-show="pop!=null"
     @click.away="pop = null">
    <template x-if="pop!=null">
    <div class="popup">
    <span>Are you sure you want to remove <span class="naam" x-text="pop.name"></span>?<br><br></span>
    <button class="cancel" @click="del(pop.id)">Remove</button>
    <button class="cancel" @click="pop = null">Cancel</button>
    </div>
    </template>
</div>
