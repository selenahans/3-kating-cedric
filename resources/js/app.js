import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const mobileBreakpoint = window.matchMedia('(min-width: 1024px)');
const overlay = document.getElementById('sidebarOverlay');
const desktopStorageKey = 'biblo.sidebarDesktopCollapsed';

function setSidebarOpen(isOpen) {
	if (mobileBreakpoint.matches) {
		document.body.classList.remove('sidebar-mobile-open');
		if (overlay) {
			overlay.classList.remove('opacity-100', 'pointer-events-auto');
			overlay.classList.add('opacity-0', 'pointer-events-none');
		}
		return;
	}

	document.body.classList.toggle('sidebar-mobile-open', isOpen);

	if (!overlay) {
		return;
	}

	overlay.classList.toggle('opacity-100', isOpen);
	overlay.classList.toggle('pointer-events-auto', isOpen);
	overlay.classList.toggle('opacity-0', !isOpen);
	overlay.classList.toggle('pointer-events-none', !isOpen);
}

window.toggleSidebar = function toggleSidebar(forceState) {
	if (mobileBreakpoint.matches) {
		const willCollapse = typeof forceState === 'boolean'
			? !forceState
			: !document.body.classList.contains('sidebar-desktop-collapsed');

		document.body.classList.toggle('sidebar-desktop-collapsed', willCollapse);
		window.localStorage.setItem(desktopStorageKey, willCollapse ? '1' : '0');
		return;
	}

	const willOpen = typeof forceState === 'boolean'
		? forceState
		: !document.body.classList.contains('sidebar-mobile-open');

	setSidebarOpen(willOpen);
};

if (overlay) {
	overlay.addEventListener('click', () => setSidebarOpen(false));
}

const restoreDesktopSidebarState = () => {
	if (!mobileBreakpoint.matches) {
		document.body.classList.remove('sidebar-desktop-collapsed');
		return;
	}

	const storedValue = window.localStorage.getItem(desktopStorageKey);
	document.body.classList.toggle('sidebar-desktop-collapsed', storedValue === '1');
};

restoreDesktopSidebarState();
mobileBreakpoint.addEventListener('change', () => {
	setSidebarOpen(false);
	restoreDesktopSidebarState();
});
