import * as vscode from 'vscode';
import { GitManager } from './gitManager';

let gitManager: GitManager;

export function activate(context: vscode.ExtensionContext) {
	console.log('Laravel Git extension is now active!');

	// Initialize Git manager
	gitManager = new GitManager();

	// Register commands
	const statusCommand = vscode.commands.registerCommand('vscode-laravel-git.status', () => {
		gitManager.showStatus();
	});

	const commitCommand = vscode.commands.registerCommand('vscode-laravel-git.commit', () => {
		gitManager.commitChanges();
	});

	const pushCommand = vscode.commands.registerCommand('vscode-laravel-git.push', () => {
		gitManager.pushChanges();
	});

	const pullCommand = vscode.commands.registerCommand('vscode-laravel-git.pull', () => {
		gitManager.pullChanges();
	});

	const logCommand = vscode.commands.registerCommand('vscode-laravel-git.log', () => {
		gitManager.showLog();
	});

	const branchCommand = vscode.commands.registerCommand('vscode-laravel-git.branch', () => {
		gitManager.showBranches();
	});

	const checkoutCommand = vscode.commands.registerCommand('vscode-laravel-git.checkout', () => {
		gitManager.checkoutBranch();
	});

	context.subscriptions.push(statusCommand);
	context.subscriptions.push(commitCommand);
	context.subscriptions.push(pushCommand);
	context.subscriptions.push(pullCommand);
	context.subscriptions.push(logCommand);
	context.subscriptions.push(branchCommand);
	context.subscriptions.push(checkoutCommand);

	// Create status bar item
	const statusBarItem = vscode.window.createStatusBarItem(vscode.StatusBarAlignment.Left, 100);
	statusBarItem.command = 'vscode-laravel-git.status';
	statusBarItem.text = '$(git-branch) Laravel Git';
	statusBarItem.tooltip = 'Laravel Git Extension';
	statusBarItem.show();
	context.subscriptions.push(statusBarItem);

	// Register Git event listeners
	gitManager.registerGitEvents();
}

export function deactivate() {
	console.log('Laravel Git extension is now deactivated!');
}