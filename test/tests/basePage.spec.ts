import { test, expect } from '@playwright/test';
import BasePage from '../pages/BasePage';

test('GIGSWP home page title and heading', async ({ page }) => {
  await page.goto('/');

  const basePage = new BasePage(page);

  await expect(basePage.logo).toBeVisible();
  await expect(basePage.searchHeading).toBeVisible();
  
});

