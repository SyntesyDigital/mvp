//------------------------------------------//
//      BOOTSTRAP FOR ARCHITECT LIB
//      @syntey-digital - 2018
//------------------------------------------//
var architect = {

    currentUserHasRole: function(roleName) {
        var user = CURRENT_USER;

        if(!user) {
            return false;
        }

        return roleName == user.role;
    },

};
