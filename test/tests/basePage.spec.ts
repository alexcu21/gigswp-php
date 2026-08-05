import { test, expect } from '@playwright/test';
import BasePage from '../pages/BasePage';

test('GIGSWP home page title and heading', async ({ page }) => {
  await page.goto('http://127.0.0.1:8000');

  const basePage = new BasePage(page);

  await expect(basePage.logo).toBeVisible();
  await expect(basePage.searchHeading).toBeVisible();
  
});

