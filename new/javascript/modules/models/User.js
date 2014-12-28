define(['knockout', 'models/Model', 'user-config'], function PresetManagerHandler(ko, Model, userConfig) {
    var User = {
        getUserUrl: '/api/users/get/',
        isGuest: userConfig.isGuest,
        isModer: userConfig.isModer,
        userId: userConfig.userId,
        /**
         * Полное имя
         * @returns {string}
         */
        fullName: function fullName() {
            return this.firstName + ' ' + this.lastName;
        },
        parsePack: function parsePack(element) {
            if (element.success === true) {
                var userInst = Object.create(User);
                userInst.init(element.data);
                return userInst;
            }
        },
        /**
         * init юзера
         * @param object
         * @returns {User}
         */
        init: function init(object) {

            if (object !== undefined) {

                this.avatarId = object.avatarId;

                this.avatarUrl = object.avatarUrl;

                this.firstName = object.firstName;

                this.gender = object.gender;

                this.id = object.id;

                this.isOnline = object.isOnline;

                this.lastName = object.lastName;

                this.profileUrl = object.profileUrl;

                this.publicChannel = object.publicChannel;

                this.fullName = this.fullName();

                return this;
            }
        }
    };
    return User;
});