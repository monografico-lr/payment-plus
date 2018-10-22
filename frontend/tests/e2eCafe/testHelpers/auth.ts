import { Role } from 'testcafe';
const host = 'http://laravel57.test/';

const adminRole = Role(host, async t => {
    await t
    .typeText('#user-input', 'jguerrero')
    .typeText('#password-input', 'hola')
    .click('#btn-send-credentials');
})


export const vars = {
    adminRole,
    host
}
