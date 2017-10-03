<div v-cloak class="favorite-tags" v-if="isLoggedIn">
    <h2>Favorite Tags</h2>
        <div class="user-fav-tags">
            <span v-for="tag in userFavoriteTags" class="label">
                <i
                    v-if="editTags"
                    @click="removeTag(tag)"
                    title="click 'x' to remove tag"
                    class="fi-x"
                >
                </i>
                <a href="/tags/@{{ tag.id }}">@{{ tag.name }}</a>
            </span>
        </div>
        <form v-show="editTags" v-on:submit.prevent="onTagsSubmit">
            <div class="form-group">
                <label>Tags:
                    <select v-select="selectedTags" multiple>
                        <option v-for="tag in allTags" value="@{{ tag.id }}">
                            @{{ tag.name }}
                        </option>
                    </select>
                </label>
            </div>
            <button v-if="selectedTags" style="margin-top: 5px" type="submit" class="button">Add</button>
        </form>
        <div class="toggler">
            <a v-if="!editTags" @click="editTags = true">Edit Tags</a>
            <a v-if="editTags" @click="editTags = false">Done</a>
        </div>
    <p class="note">
        <i>
            *Highlighted questions means your tags are on that question.
        </i>
    </p>
</div>
