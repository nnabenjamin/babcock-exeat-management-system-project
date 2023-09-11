// Sanitize user data
let sanitize_data = (data) => {
    return data.split('"').join('').replace(/^[ ]+|[ ]+$/g, '').trim();
}
//------------------------------------------

// Validate email
let validate_email = (email) => {
    let mailformat = /.+@.+\..+/; //Mail validation RegEx

    if (email.match(mailformat)){
        return true; //Email is valid - True
    } else {
        return false; //Email is not valid - False
    }
}
//-------------------------------------------