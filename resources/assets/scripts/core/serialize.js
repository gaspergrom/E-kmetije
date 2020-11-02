export default (form) => {
    const inputs = form.serializeArray();
    const data = {};
    console.log(inputs);
    inputs.forEach((input) => {
        if (input.name in data) {
            if (typeof data[input.name] === 'string') {
                data[input.name] = [data[input.name], input.value];
            }
            else {
                data[input.name].push(input.value);
            }
        }
        else {
            data[input.name] = input.value;
        }
    });
    return data;
}
