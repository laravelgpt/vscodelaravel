import * as vscode from 'vscode';
import { exec } from 'child_process';
import { promisify } from 'util';

const execPromise = promisify(exec);

export class GitManager {
	private channel: vscode.OutputChannel;
	private lastStatus: string = '';

	constructor() {
		this.channel = vscode.window.createOutputChannel('Laravel Git');
	}

	public async showStatus(): Promise<void> {
		try {
			const result = await this.executeGitCommand('status --porcelain');
			this.lastStatus = result.stdout;
			if (result.stdout) {
				vscode.window.showInformationMessage(`Git Status:\n${result.stdout}`);
				this.channel.appendLine(`Status:\n${result.stdout}`);
				this.channel.show();
			} else {
				vscode.window.showInformationMessage('Working directory is clean');
			}
		} catch (error: any) {
			vscode.window.showErrorMessage(`Error getting status: ${error.message}`);
			this.channel.appendLine(`Error: ${error.message}`);
			this.channel.show();
		}
	}

	public async commitChanges(): Promise<void> {
		const message = await vscode.window.showInputBox({
			prompt: 'Enter commit message',
			placeHolder: 'Commit message'
		});

		if (message) {
			try {
				await this.executeGitCommand(`add .`);
				const result = await this.executeGitCommand(`commit -m "${message}"`);
				vscode.window.showInformationMessage(`Committed: ${message}`);
				this.channel.appendLine(`Commit: ${result.stdout}`);
				this.channel.show();
				// Refresh status after commit
				this.showStatus();
			} catch (error: any) {
				vscode.window.showErrorMessage(`Error committing: ${error.message}`);
				this.channel.appendLine(`Error: ${error.message}`);
				this.channel.show();
			}
		}
	}

	public async pushChanges(): Promise<void> {
		try {
			const result = await this.executeGitCommand('push');
			vscode.window.showInformationMessage('Pushed changes successfully');
			this.channel.appendLine(`Push: ${result.stdout}`);
			this.channel.show();
		} catch (error: any) {
			vscode.window.showErrorMessage(`Error pushing: ${error.message}`);
			this.channel.appendLine(`Error: ${error.message}`);
			this.channel.show();
		}
	}

	public async pullChanges(): Promise<void> {
		try {
			const result = await this.executeGitCommand('pull');
			vscode.window.showInformationMessage('Pulled changes successfully');
			this.channel.appendLine(`Pull: ${result.stdout}`);
			this.channel.show();
			// Refresh status after pull
			this.showStatus();
		} catch (error: any) {
			vscode.window.showErrorMessage(`Error pulling: ${error.message}`);
			this.channel.appendLine(`Error: ${error.message}`);
			this.channel.show();
		}
	}

	public async showLog(): Promise<void> {
		try {
			const result = await this.executeGitCommand('log --oneline -10');
			if (result.stdout) {
				vscode.window.showInformationMessage(`Git Log:\n${result.stdout}`);
				this.channel.appendLine(`Log:\n${result.stdout}`);
				this.channel.show();
			} else {
				vscode.window.showInformationMessage('No commits found');
			}
		} catch (error: any) {
			vscode.window.showErrorMessage(`Error getting log: ${error.message}`);
			this.channel.appendLine(`Error: ${error.message}`);
			this.channel.show();
		}
	}

	public async showBranches(): Promise<void> {
		try {
			const result = await this.executeGitCommand('branch');
			if (result.stdout) {
				vscode.window.showInformationMessage(`Git Branches:\n${result.stdout}`);
				this.channel.appendLine(`Branches:\n${result.stdout}`);
				this.channel.show();
			} else {
				vscode.window.showInformationMessage('No branches found');
			}
		} catch (error: any) {
			vscode.window.showErrorMessage(`Error getting branches: ${error.message}`);
			this.channel.appendLine(`Error: ${error.message}`);
			this.channel.show();
		}
	}

	public async checkoutBranch(): Promise<void> {
		try {
			// First get list of branches
			const branchResult = await this.executeGitCommand('branch');
			const branches = branchResult.stdout.split('\n')
				.map(branch => branch.trim().replace('* ', ''))
				.filter(branch => branch.length > 0);

			if (branches.length === 0) {
				vscode.window.showErrorMessage('No branches found');
				return;
			}

			// Show quick pick to select branch
			const selectedBranch = await vscode.window.showQuickPick(branches, {
				placeHolder: 'Select branch to checkout'
			});

			if (selectedBranch) {
				const result = await this.executeGitCommand(`checkout ${selectedBranch}`);
				vscode.window.showInformationMessage(`Switched to branch: ${selectedBranch}`);
				this.channel.appendLine(`Checkout: ${result.stdout}`);
				this.channel.show();
				// Refresh status after checkout
				this.showStatus();
			}
		} catch (error: any) {
			vscode.window.showErrorMessage(`Error checking out branch: ${error.message}`);
			this.channel.appendLine(`Error: ${error.message}`);
			this.channel.show();
		}
	}

	public registerGitEvents(): void {
		// Listen for file system changes to update status
		const fileWatcher = vscode.workspace.createFileSystemWatcher('**/*');
		fileWatcher.onDidChange(() => {
			// Debounce status updates
			setTimeout(() => {
				this.showStatus();
			}, 1000);
		});
		
		// Listen for workspace changes
		vscode.workspace.onDidChangeWorkspaceFolders(() => {
			this.showStatus();
		});
	}

	private async executeGitCommand(command: string): Promise<{ stdout: string; stderr: string }> {
		const workspaceFolder = vscode.workspace.rootPath || '.';
		const gitPath = vscode.workspace.getConfiguration('vscode-laravel-git').get('gitPath') || 'git';
		const fullCommand = `cd "${workspaceFolder}" && ${gitPath} ${command}`;
		
		this.channel.appendLine(`Executing: ${fullCommand}`);
		
		try {
			const result = await execPromise(fullCommand, { maxBuffer: 1024 * 1024 });
			return result;
		} catch (error: any) {
			throw new Error(`Command failed: ${error.message}`);
		}
	}
}