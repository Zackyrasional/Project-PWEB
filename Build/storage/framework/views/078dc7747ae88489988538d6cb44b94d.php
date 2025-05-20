

<?php $__env->startSection('title', 'My Transactions'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>My Transactions</h5>
                <a href="<?php echo e(route('transactions.create')); ?>" class="btn btn-primary">
                    <i class="bi bi-plus"></i> Add Transaction
                </a>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="card bg-success text-white">
                            <div class="card-body p-3">
                                <h6 class="card-title">Total Income</h6>
                                <p class="card-text h4">Rp <?php echo e(number_format($totalIncome, 0, ',', '.')); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-danger text-white">
                            <div class="card-body p-3">
                                <h6 class="card-title">Total Expense</h6>
                                <p class="card-text h4">Rp <?php echo e(number_format($totalExpense, 0, ',', '.')); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-primary text-white">
                            <div class="card-body p-3">
                                <h6 class="card-title">Balance</h6>
                                <p class="card-text h4">Rp <?php echo e(number_format($balance, 0, ',', '.')); ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <form action="<?php echo e(route('transactions.index')); ?>" method="GET" class="row g-3">
                        <div class="col-md-3">
                            <select name="type" class="form-select">
                                <option value="">All Types</option>
                                <option value="income" <?php echo e(request('type') == 'income' ? 'selected' : ''); ?>>Income</option>
                                <option value="expense" <?php echo e(request('type') == 'expense' ? 'selected' : ''); ?>>Expense</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input type="month" name="month" class="form-control" value="<?php echo e(request('month')); ?>">
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control" placeholder="Search..." value="<?php echo e(request('search')); ?>">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-outline-primary w-100">Filter</button>
                        </div>
                    </form>
                </div>

                <?php if($transactions->count() > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Type</th>
                                    <th>Category</th>
                                    <th>Amount</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($transaction->date->format('d M Y')); ?></td>
                                        <td>
                                            <span class="badge bg-<?php echo e($transaction->type === 'income' ? 'success' : 'danger'); ?>">
                                                <?php echo e(ucfirst($transaction->type)); ?>

                                            </span>
                                        </td>
                                        <td><?php echo e($transaction->category); ?></td>
                                        <td class="<?php echo e($transaction->type === 'income' ? 'text-success' : 'text-danger'); ?>">
                                            Rp <?php echo e(number_format($transaction->amount, 0, ',', '.')); ?>

                                        </td>
                                        <td><?php echo e($transaction->description ?? '-'); ?></td>
                                        <td>
                                            <a href="<?php echo e(route('transactions.edit', $transaction->id)); ?>" class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="<?php echo e(route('transactions.destroy', $transaction->id)); ?>" method="POST" class="d-inline">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">
                        <?php echo e($transactions->appends(request()->query())->links()); ?>

                    </div>
                <?php else: ?>
                    <div class="alert alert-info">
                        No transactions found. <a href="<?php echo e(route('transactions.create')); ?>">Add your first transaction</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\financial_app\resources\views/transactions/index.blade.php ENDPATH**/ ?>