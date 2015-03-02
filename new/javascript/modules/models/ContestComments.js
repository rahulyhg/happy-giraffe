define(['knockout', 'models/Model', 'models/User', 'models/Contest'], function ContestCommentsHandler(ko, Model, User, Contest) {
    var ContestComments = Object.create(Contest);
    ContestComments.getRatingList = function getRatingList() {
        return Model.get(this.getRatingListUrl, { contestId: this.id, limit: this.ratingLimit, offset: this.ratingOffset});
    };
    ContestComments.getContestComments = function getContestComments(userId) {
        return Model.get(this.getContestCommentsUrl, { contestId: this.id, limit: this.commentsLimit, offset: this.commentsOffset, userId: userId });
    };
    Object.defineProperties(ContestComments, {
        "getRatingListUrl": {
            value: '/api/commentatorsContest/ratingList/',
            writable: false
        },
        "getContestCommentsUrl": {
            value: '/api/commentatorsContest/comments/',
            writable: false
        },
        "ratingLimit": {
            value: 5,
            writable: true
        },
        "commentsLimit": {
            value: 3,
            writable: true
        },
        "commentsOffset": {
            value: null,
            writable: true
        },
        "ratingOffset": {
            value: null,
            writable: true
        },
        "userId": {
            value: null,
            writable: true
        },
        "place": {
            value: null,
            writable: true
        },
        "score": {
            value: null,
            writable: true
        },
        "user": {
            value: Object.create(User),
            writable: true
        },
        "comments": {
            value: [],
            writable: true
        }
    });
    return ContestComments;
});
