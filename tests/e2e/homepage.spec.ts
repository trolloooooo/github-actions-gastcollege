import { test, expect } from '@playwright/test';

test('Can visit the homepage', async ({ page }) => {
    await page.goto('/');

    await expect(page.locator('.pokemon-list')).toBeVisible();
    await expect(await page.locator('.pokemon-list > .pokemon').count()).toBe(13 * 4);
});
