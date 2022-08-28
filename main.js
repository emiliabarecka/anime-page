const commentArea = document.querySelector('.comment');
const alert = document.querySelector('.alert');
let userType = null;
console.log(userType);


if(commentArea && alert){
    commentArea.addEventListener('focus', () => {
        userType = document.querySelector('#userType');
        if(userType != null){
            console.log(userType.value);
        }else{
            console.log('nie ma usera');
            alert.classList.remove('d-none');
            alert.classList.add('d-block');
        }
    })
}
