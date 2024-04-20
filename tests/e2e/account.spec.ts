import { test, expect } from '@playwright/test';

test('Can register, logout and login', async ({ page }) => {
    await page.goto('/');

    await page.click('text=Register');
    expect(page.url()).toContain('/register');

    const email = new Date().getTime() + '-john.doe@example';

    await page.fill('input[name="name"]', 'John Doe');
    await page.fill('input[name="email"]', email);
    await page.fill('input[name="password"]', 'password');
    await page.fill('input[name="password_confirmation"]', 'password');
    await page.getByRole('button', { name: 'Register' }).click();

    expect(page.url()).toContain('/dashboard');

    await page.waitForTimeout(1000);

    await page.getByRole('button', { name: 'John Doe' }).click();
    await page.locator('a').filter({ hasText: /^Log Out$/ }).click();

    expect(page.url()).toContain('/');

    await page.click('text=Log In');
    expect(page.url()).toContain('/login');

    await page.fill('input[name="email"]', email);
    await page.fill('input[name="password"]', 'password');

    await page.getByRole('button', { name: 'Log In' }).click();
    expect(page.url()).toContain('/dashboard');
});
