var authUserId = window.authUserId;

Vue.directive('select', {

    twoWay: true,
    priority: 1000,

    bind: function() {
        var self = this;
        $(this.el)
            .select2({})
            .on('change', function() {
                self.set($(self.el).val());
            })
    },

    update: function(value) {
        $(this.el).val(value).trigger('change');
    },

    unbind: function() {
        $(this.el).off().select2('destroy');
    }
});

new Vue({

    el: '#Sidebar',

    data: {
        isLoggedIn: window.isLoggedIn,
        userFavoriteTags: [],
        selectedTags: [],
        allTags: [],
        editTags: false
    },

    created() {
        if(this.isLoggedIn) {
            this.getTagsByUser(authUserId);
            this.getAllTags();
        }
    },

    methods: {
        removeTag(tag) {

            var self = this;

            axios.get('/ajax/user/remove-tag/' + tag.id)
                .then(function (response) {
                    self.userFavoriteTags = self.userFavoriteTags.filter(function (obj) {
                        return obj.id !== response.data;
                    });
                })
                .catch(function (error) {
                    console.log(error);
                })
        },

        getAllTags() {
            axios.get('/ajax/tags/all')
                .then(response =>
                    this.allTags = response.data
                ).catch(error =>
                console.log(error)
            );
        },

        getTagsByUser(authUserId) {

            var self = this;

            axios.get('/ajax/tags/user/' + authUserId)
                .then(function (response) {
                    self.userFavoriteTags = response.data;
                }).catch(function (error) {
                    console.log(error)
                });
        },

        onTagsSubmit() {

            var self = this;

            axios.post('/ajax/user/add-tags', {
                tagsToAdd: this.selectedTags
            })
                .then(function (response) {
                    if(response.data.attachedCount > 0) {
                        self.userFavoriteTags.push(...response.data.tagObjects);
                    }
                })
                .catch(function (error) {
                    console.log(error);
                })

            this.selectedTags = [];
        }
    }
});